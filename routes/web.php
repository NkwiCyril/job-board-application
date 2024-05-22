<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


// routes concerned with home page (guest, seeker and company)
Route::get('home', [HomeController::class, 'index'])->name('home.index');


// login routes
Route::controller(LoginController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });


// register routes
Route::controller(RegisterController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('register', 'register')->name('register');
    });


// routes concerned with opportunities
Route::controller(OpportunityController::class)
    ->prefix('opportunities')
    ->name('opportunities.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::get('publish/{id}', 'publish')->name('publish');
        Route::get('unpublish/{id}', 'unpublish')->name('unpublish');
        Route::get('{id}', 'show')->name('show');
        Route::post('store', 'store')->name('store');
        Route::put('{id}', 'update')->name('update');
        Route::delete('{id}', 'destroy')->name('destroy');
    });

// routes concerned with applications

Route::controller(ApplicationController::class)
    ->prefix('applications')
    ->name('applications.')
    ->group(function () {
        Route::get('{id}', 'create')->name('create');
        Route::post('store', 'store')->name('store');
    });


// fallback 404 view in case of invalid route parameters
Route::fallback(function () {
    return view('error.error_page');
});
