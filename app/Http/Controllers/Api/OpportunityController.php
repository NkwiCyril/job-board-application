<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Requests\UpdateOpportunityRequest;
use App\Models\Opportunity;
use Illuminate\Http\JsonResponse;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $opportunities = Opportunity::all();

        try {
            if (isset($opportunities)) {

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
    public function show(string $id): JsonResponse
    {
        try {
            $opportunity = Opportunity::where([
                'id' => $id,
            ]);

            if ($opportunity->exists()) {

                $opportunity = $opportunity->first();

                return response()->json([
                    'status' => 1,
                    'message' => 'Opportunity retrieved successfully',
                    'data' => $opportunity,
                ]);
            } else {
                return response()->json([
                    'error' => 'Opportunity not found',
                    'status' => 0,
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error encountered: '.$e->getMessage(),
                'status' => 0,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpportunityRequest $request, string $id): JsonResponse
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

                return response()->json([
                    'message' => 'Opportunity updated successfully!',
                    'status' => 1,
                    'data' => $opportunity,
                ], 200);

            } else {
                return response()->json([
                    'message' => 'Opportunity not found. Try again!',
                    'status' => 0,
                ], 404);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unable to update opportunity. Try again!',
                'error' => 'Error encountered: '.$e->getMessage(),
                'status' => 0,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $opportunity = Opportunity::where([
            'id' => $id,
        ]);

        try {

            if ($opportunity->exists()) {
                $opportunity = $opportunity->first();

                $opportunity->delete();

                return response()->json([
                    'message' => 'Opportunity deleted successfully',
                    'status' => 1,
                ]);
            } else {
                return response()->json([
                    'message' => 'Opportunity not found',
                    'status' => 0,
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'error' => 'Internal server error: '.$e->getMessage(),
            ]);
        }
    }
}
