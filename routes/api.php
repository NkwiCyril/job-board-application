<?php

use App\Http\Controllers\Api\ApplicationController;
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
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::get('logout', 'logout')->middleware('auth:sanctum');
    });

/**
 * Endpoints for opportunities
 * Require API authentication
 */
Route::controller(OpportunityController::class)
    ->prefix('opps')
    ->group(function () {
        Route::get('publish/{id}', 'publish');
        Route::get('unpublish/{id}', 'unpublish');
        Route::get('filter', 'filter');
    });

Route::apiResource('opps', OpportunityController::class);

/**
 * Endpoints for applications
 * Do not require API authentication
 */
Route::apiResource('apps', ApplicationController::class)->except('store');
Route::controller(ApplicationController::class)
    ->prefix('apps')
    ->group(function () {
        Route::post('{id}', 'store');
    });