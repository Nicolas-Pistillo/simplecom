<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\EcommerceController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

// Check later -> Route::get('/asset' , [TenantAssetsController::class, 'asset'])->name('stancl.tenancy.asset');

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

        Route::middleware('guest:admin')->group(function() {

            Route::view('/', 'admin.login')->name('admin.login-view');

            Route::post('login', [AuthController::class, 'loginAdmin'])->name('admin.login');

        });

        Route::middleware('auth:admin')->group(function() {

            Route::prefix('dashboard')->group(function() {

                Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

            });

        });

    });
});
