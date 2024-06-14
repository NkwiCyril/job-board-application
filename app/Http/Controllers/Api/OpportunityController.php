<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterOpportunitiesRequest;
use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Requests\UpdateOpportunityRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\OpportunityResource;
use App\Models\Opportunity;
use Illuminate\Http\Resources\Json\JsonResource;

class OpportunityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'filter']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        $opportunities = Opportunity::all();

        try {
            if (isset($opportunities)) {

                return new OpportunityResource($opportunities);
            } else {
                return new ErrorResource('Could not find opportunities');
            }
        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: '.$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  object  $request
     */
    public function store(StoreOpportunityRequest $request): JsonResource
    {
        $validatedRequest = $request->validated();

        try {

            $file = $validatedRequest['image_url'];

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('storage/images');
            $file->move($destinationPath, $fileName);
            $validatedRequest['image_url'] = '/storage/images/'.$fileName;

            $opp = new Opportunity();

            $opp->title = $validatedRequest['title'];
            $opp->description = $validatedRequest['description'];
            $opp->image_url = $validatedRequest['image_url'];
            $opp->user_id = $validatedRequest['user_id'];
            $opp->category_id = $validatedRequest['category_id'];

            $opp->save();

            return new OpportunityResource($opp);

        } catch (\Exception $e) {

            logger()->error($e->getMessage());

            return new ErrorResource('An error has been encountered: '.$e->getMessage());

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResource
    {
        try {
            $opportunity = Opportunity::where([
                'id' => $id,
            ]);

            if ($opportunity->exists()) {

                $opportunity = $opportunity->first();

                return new OpportunityResource($opportunity);
            } else {
                return new ErrorResource('Could not find opportunity');
            }

        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  object  $request
     */
    public function update(UpdateOpportunityRequest $request, int $id): JsonResource
    {

        try {

            $opportunity = Opportunity::where('id', $id);

            if ($opportunity->exists()) {

                $validatedData = $request->validated();

                $opportunity = $opportunity->first();

                // check if file exists
                if (isset($validatedData['image_url'])) {

                    $file = $validatedData->file('image_url');

                    $fileName = $file->getClientOriginalName();
                    $destinationPath = public_path('storage/images');
                    $file->move($destinationPath, $fileName);
                    $opportunity->image_url = '/storage/images/'.$fileName;
                }

                $opportunity->title = $validatedData['title'] ?? $opportunity->title;
                $opportunity->description = $validatedData['description'] ?? $opportunity->description;
                $opportunity->category_id = $validatedData['category'] ?? $opportunity->category_id;

                $opportunity->save();

                return new OpportunityResource($opportunity);

            } else {
                return new ErrorResource('Counld not find opportunity');
            }

        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResource
    {
        $opportunity = Opportunity::where([
            'id' => $id,
        ]);

        try {

            if ($opportunity->exists()) {
                $opportunity = $opportunity->first();

                $opportunity->delete();

                return new OpportunityResource('Opportunity deleted successfully');
            } else {
                return new ErrorResource('Opportunity does not exist');
            }

        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: '.$e->getMessage());
        }
    }

    /**
     * Publish an opportunity
     */
    public function publish(int $id): JsonResource
    {
        $opportunity = Opportunity::where([
            'id' => $id,
        ]);

        try {

            if ($opportunity->exists()) {

                $opportunity = $opportunity->first();

                if ($opportunity->published_at == null) {
                    $opportunity->published_at = now();
                    $opportunity->save();

                    return new OpportunityResource($opportunity);
                } else {
                    return new ErrorResource('Opportunity already published');
                }
            } else {
                return new ErrorResource('Could not find opportunity');
            }

        } catch (\Exception $e) {
            return new ErrorResource('An error has been encountered: '.$e->getMessage());
        }
    }

    /**
     * Unpublish an opportunity
     */
    public function unpublish(int $id): JsonResource
    {
        $opportunity = Opportunity::where([
            'id' => $id,
        ]);

        try {

            if ($opportunity->exists()) {

                $opportunity = $opportunity->first();

                if ($opportunity->published_at !== null) {
                    $opportunity->published_at = null;
                    $opportunity->save();

                    return new OpportunityResource($opportunity);
                } else {
                    return new ErrorResource('Opportunity is not published');
                }
            } else {
                return new ErrorResource('Could not find opportunity');
            }

        } catch (\Exception $e) {
            return new ErrorResource('Internal server error: '.$e->getMessage());
        }
    }

    /**
     * Filter opportunities by text (title, description) category and date published.
     *
     * @param  object  $request
     */
    public function filter(FilterOpportunitiesRequest $request): JsonResource
    {
        try {
            $validatedRequest = $request->validated();

            $title = $validatedRequest['title'] ?? null;
            $category = $validatedRequest['category_id'] ?? null;
            $published_at = $validatedRequest['published_at'] ?? null;

            $query = Opportunity::query();

            if ($title) {
                $query->where('title', 'like', '%'.$title.'%');
            }

            if ($category) {
                $query->where('category', $category);
            }

            if ($published_at) {
                $query->whereDate('published_at', $published_at);
            }

            $opportunities = $query->get();

            return new OpportunityResource($opportunities);
        } catch (\Exception $e) {
            return new ErrorResource('Internal Server Error: '.$e->getMessage());
        }
    }
}
