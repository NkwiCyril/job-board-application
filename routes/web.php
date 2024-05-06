<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ----------------------------------------------------------------
// routes concerned with authentication
// ----------------------------------------------------------------

// login routes
Route::get('login', [LoginController::class, 'login'])->name('auth.login');
Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('login', [LoginController::class, 'authenticate'])->name('auth.authenticate');


// register routes
Route::get('register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('register', [RegisterController::class,'register_user'])->name('auth.register');



// routes concerned with home page (all users, seeker or company)
Route::get('/', [HomeController::class, 'user_home'])->name('pages.home');
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');


// routes concerned with profile
Route::get('profile/{id}', [ProfileController::class, 'view_profile'])->name('pages.profile');
Route::patch('profile/edit/{id}', [ProfileController::class, 'edit_profile'])->name('pages.edit_profile');

// routes concerned with opportunities
Route::patch('opportunity/edit/{id}', [OpportunityController::class, 'edit_opportunity'])->name('pages.edit_opportunity');
Route::get('opportunity/delete/{id}', [OpportunityController::class, 'delete_opportunity'])->name('pages.delete_opportunity');
Route::get('opportunity/create', [OpportunityController::class, 'create_opportunity'])->name('pages.create_opportunity');
Route::post('opportunity/create', [OpportunityController::class,'store_opportunity'])->name('pages.store_opportunity');
Route::get('opportunity/{id}', [OpportunityController::class, 'view_opportunity'])->name('pages.opportunity');


// routes concerned with applications
Route::get('applications', [ApplicationController::class, 'all_application'])->name('pages.applications');
Route::patch('application/edit/{id}', [ApplicationController::class, 'edit_application'])->name('pages.edit_application');
Route::get('application/delete/{id}', [ApplicationController::class, 'delete_application'])->name('pages.delete_application');
Route::get('application/create', [ApplicationController::class, 'create_application'])->name('pages.create_application');
Route::post('application/create/{id}', [ApplicationController::class,'store_application'])->name('pages.store_application');
Route::get('application/{id}', [ApplicationController::class, 'view_application'])->name('pages.application');

// fallback 404 view in case of invalid route parameters
Route::fallback(function() {
    return view('error.error_page');
});