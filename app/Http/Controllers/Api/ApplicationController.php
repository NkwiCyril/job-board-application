<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ErrorResource;
use App\Models\Application;
use App\Models\Opportunity;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        try {
            $applications = Application::all();

            if ($applications->isEmpty()) {
                return new ErrorResource('No applications found');
            }

            return ApplicationResource::collection($applications);
        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreApplicationRequest $request
     * @param int $id
     */
    public function store(StoreApplicationRequest $request, int $id): JsonResource
    {
        $validatedRequest = $request->validated();
        $opportunity = Opportunity::findOrFail($id);
        $user = auth()->user();

        if ($opportunity->user_id == $user->id) {
            return new ErrorResource('You cannot apply to your own opportunity');
        }

        if ($opportunity->applications->contains('user_id', $user->id)) {
            return new ErrorResource('You have already applied to this opportunity');
        }

        try {
            $file = $validatedRequest['resume'];
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('storage/images');
            $file->move($destinationPath, $fileName);
            $validatedRequest['resume'] = '/storage/images/' . $fileName;

            $application = new Application();
            $application->user_id = $user->id;
            $application->opp_id = $opportunity->id;
            $application->bio = $validatedRequest['bio'];
            $application->cv_link = $validatedRequest['resume'];
            $application->application_date = now();
            $application->save();

            return new ApplicationResource($application);
        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     */
    public function show(int $id): JsonResource
    {
        try {
            $application = Application::findOrFail($id);

            return new ApplicationResource($application);
        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     */
    public function destroy(int $id): JsonResource
    {
        $application = Application::where([
            'id' => $id,
        ]);

        try {

            if ($application->exists()) {
                $application = $application->first();

                $application->delete();

                return new ApplicationResource('Application deleted successfully');
            } else {
                return new ErrorResource('Application does not exist');
            }

        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: '.$e->getMessage());
        }
    }
}
