<?php

use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\LoginController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'landing')->name('simplecom.landing');

/* SUPERADMIN ROUTES */
Route::prefix('superadmin')->group(function() {

    // Superadmin unauthenticated routes
    Route::middleware('guest:superadmin')->group(function() {

        Route::view('/', 'superadmin.login')->name('superadmin.login-view');

        Route::post('login', [LoginController::class, 'login'])->name('superadmin.login');

    });

    // Superadmin authenticated routes
    Route::middleware('auth:superadmin')->group(function() {

        Route::prefix('dashboard')->group(function() {

            Route::get('/', [DashboardController::class, 'index'])->name('superadmin.dashboard.index');

        });

    });

});