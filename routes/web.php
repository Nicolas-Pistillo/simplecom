<?php

use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\AuthController;
use App\Http\Controllers\Superadmin\TenantController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::view('/', 'landing')->name('simplecom.landing');

Route::post('payment-providers/nave/webhook', function() {
    Log::channel('resources')
        ->info("Webhook de nave recibido en dominio principal", request()->all());

    Log::info("Webhook de nave recibido en dominio principal", request()->all());
});

/* SUPERADMIN ROUTES */
Route::prefix('superadmin')->group(function() {

    // Superadmin unauthenticated routes
    Route::middleware('guest:superadmin')->group(function() {

        Route::view('/', 'superadmin.login')->name('superadmin.login-view');

        Route::post('login', [AuthController::class, 'login'])->name('superadmin.login');

    });

    // Superadmin authenticated routes
    Route::middleware('auth:superadmin')->group(function() {

        Route::post('logout', [AuthController::class, 'logout'])->name('superadmin.logout');

        Route::prefix('dashboard')->group(function() {

            Route::get('/', [DashboardController::class, 'index'])->name('superadmin.dashboard.index');

            // Tenants management
            Route::name('superadmin.')->group(function() 
            {
                Route::resource('tenants', TenantController::class);
            });

        });

    });

});