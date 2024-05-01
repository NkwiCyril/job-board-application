<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PagesController;

/**
 * Welcome page route
 */

Route::get('/', [PagesController::class, 'index'])->name('welcome');

/**
 * Authentication routes
 * register, login, logout for all users
 * @author: Nkwi Cyril <akinimbomnkwi@gmail.com>
 */
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/**
 * 
 */