<?php

use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\AuthController;
use App\Http\Controllers\Superadmin\TenantController;
use App\Http\Controllers\Tenant\PaymentWebhookController;
use App\Http\Controllers\Tenant\InvoiceWebhookController;
use App\Http\Controllers\Tenant\ShippingWebhookController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('simplecom.landing');

// Tenant Payment Webhooks
Route::post('webhooks/tenant-payments/{tenant}/{order}/{provider}', [PaymentWebhookController::class, 'handler'])
    ->withoutMiddleware('web')
    ->name('tenant.payment-webhook');

// Tenant Shipping Webhooks
Route::post('webhooks/tenant-shippings/{tenant}/{orderShipping}/{provider}', [ShippingWebhookController::class, 'handler'])
    ->withoutMiddleware('web')
    ->name('tenant.shipping-webhook');

// Tenant Invoices Webhooks
Route::post('webhooks/tenant-invoices', [InvoiceWebhookController::class, 'handler'])
    ->withoutMiddleware('web')
    ->name('tenant.invoice-webhook');

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