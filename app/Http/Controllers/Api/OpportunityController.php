<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpportunityRequest;
use App\Models\Opportunity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $opportunities = Opportunity::whereNotNull('published_at');

        try {
            if ($opportunities->exists()) {
                $opportunities = $opportunities->get();

                return response()->json([
                    'status' => 1,
                    'message' => 'Retrieved published opportunities successfully!.',
                    'data' => $opportunities,
                ], 200);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'No opportunities found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'An error has been encountered: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpportunityRequest $request): JsonResponse
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

            return response()->json([
                'status' => 1,
                'message' => 'Opportunity created successfully.',
                'data' => $opp,
            ], 201);

        } catch (\Exception $e) {

            logger()->error($e->getMessage());

            return response()->json([
                'status' => 0,
                'message' => 'An error has been encountered: '.$e->getMessage(),
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
