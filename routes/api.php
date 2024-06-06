<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OpportunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Endpoints for user login and registration
 * Do not require API authentication
 */
Route::controller(AuthController::class)
    ->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

/**
 * Endpoints for opportunities
 * Require API authentication
 */
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('opps', OpportunityController::class);

    Route::controller(AuthController::class)
        ->group(function () {
            Route::get('logout', [AuthController::class, 'logout']);
        });
});
