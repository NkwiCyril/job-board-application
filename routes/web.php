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
Route::get('register', [RegisterController::class, 'index'])->name('auth.register');
Route::post('register', [RegisterController::class,'register'])->name('auth.register');



// routes concerned with home page (guest, seeker and company)
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
Route::get('/', [HomeController::class, 'home'])->name('pages.home');


// routes concerned with opportunities
Route::get('opportunity/create', [OpportunityController::class, 'create'])->name('pages.create_opportunity');
Route::post('opportunity/create', [OpportunityController::class,'store'])->name('pages.store_opportunity');
Route::get('opportunity/edit/{id}', [OpportunityController::class, 'edit'])->name('pages.edit_opportunity');
Route::post('opportunity/edit/{id}', [OpportunityController::class, 'update'])->name('pages.update');
Route::get('opportunity/delete/{id}', [OpportunityController::class, 'delete'])->name('pages.delete_opportunity');
Route::get('opportunity/publish', [OpportunityController::class, 'publish_all'])->name('pages.publish_opportunity');
Route::get('opportunity/{id}', [OpportunityController::class, 'view'])->name('pages.opportunity');
Route::get('opportunity/publish/{id}', [OpportunityController::class, 'publish'])->name('pages.publish');
Route::get('opportunity/unpublish/{id}', [OpportunityController::class, 'unpublish'])->name('pages.unpublish');


// routes concerned with applications
Route::get('applications', [ApplicationController::class, 'all'])->name('pages.applications');
Route::post('application/submit/{opp_id}', [ApplicationController::class, 'send'])->name('pages.submit_application');
Route::get('application/{id}', [ApplicationController::class, 'view'])->name('pages.application');

// fallback 404 view in case of invalid route parameters
Route::fallback(function() {
    return view('error.error_page');
});