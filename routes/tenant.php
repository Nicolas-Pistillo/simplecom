<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\EcommerceController;
use App\Http\Controllers\Tenant\OperatorController;
use App\Http\Controllers\Tenant\ProductsController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    /*****  TENANT ECOMMERCE ROUTES  *****/
    Route::middleware(['tenant_setuped', 'tenant_active'])->group(function() {

        Route::get('/', [EcommerceController::class, 'index'])->name('ecommerce.index');

        Route::get('sobre-nosotros', [EcommerceController::class, 'about'])->name('ecommerce.about');

        Route::get('contacto', [EcommerceController::class, 'contact'])->name('ecommerce.contact');

    });

    /*****  TENANT ADMIN ROUTES  *****/
    Route::prefix('admin')->middleware('tenant_active')->group(function() {

        Route::middleware('guest:operator')->group(function() {

            Route::view('/', 'admin.login')->name('admin.login-view');

            Route::post('login', [AuthController::class, 'login'])->name('admin.login');

        });

        Route::middleware('auth:operator')->group(function() {

            Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

            Route::view('setup', 'admin.setup')->middleware('tenant_unsetuped')->name('admin.setup');

            Route::prefix('dashboard')->middleware('tenant_setuped')->group(function() {

                Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

                Route::view('categories', 'admin.categories.index')->name('admin.categories.index');

                Route::view('operators', 'admin.operators.index')->name('admin.operators.index');

                // Admin resource routes
                Route::name('admin.')->group(function() {

                    Route::resource('products', ProductsController::class);
                    
                });

            });

        });

    });
});
