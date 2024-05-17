<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
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
Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('login', [LoginController::class, 'authenticate'])->name('auth.authenticate');


// register routes
Route::get('register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('register', [RegisterController::class,'register_user'])->name('auth.register');



// routes concerned with home page (all users, seeker or company)
Route::get('/', [HomeController::class, 'user_home'])->name('pages.home');
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');


// routes concerned with opportunities
Route::get('opportunity/create', [OpportunityController::class, 'create_opportunity'])->name('pages.create_opportunity');
Route::post('opportunity/create', [OpportunityController::class,'store_opportunity'])->name('pages.store_opportunity');
Route::get('opportunity/edit/{id}', [OpportunityController::class, 'edit_opportunity'])->name('pages.edit_opportunity');
Route::post('opportunity/edit/{id}', [OpportunityController::class, 'update'])->name('pages.update');
Route::get('opportunity/delete/{id}', [OpportunityController::class, 'delete_opportunity'])->name('pages.delete_opportunity');
Route::get('opportunity/publish', [OpportunityController::class, 'all_published'])->name('pages.publish_opportunity');
Route::get('opportunity/{id}', [OpportunityController::class, 'view_opportunity'])->name('pages.opportunity');
Route::get('opportunity/publish/{id}', [OpportunityController::class, 'publish_opportunity'])->name('pages.publish');
Route::get('opportunity/unpublish/{id}', [OpportunityController::class, 'unpublish_opportunity'])->name('pages.unpublish');


// routes concerned with applications
Route::get('applications', [ApplicationController::class, 'all_application'])->name('pages.applications');
Route::post('application/submit/{opp_id}', [ApplicationController::class, 'send_application'])->name('pages.submit_application');
Route::get('application/{id}', [ApplicationController::class, 'view_application_form'])->name('pages.application');

// fallback 404 view in case of invalid route parameters
Route::fallback(function() {
    return view('error.error_page');
});