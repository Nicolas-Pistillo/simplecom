<?php

use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\AuthController;
use App\Http\Controllers\Superadmin\TenantController;
use App\Http\Controllers\Tenant\PaymentWebhookController;
use App\Http\Controllers\Tenant\InvoiceWebhookController;
use App\Http\Controllers\Tenant\ShippingWebhookController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('simplecom.landing');

Route::get('test-email', function() 
{
    Mail::to('pistillonicolas@gmail.com')->send(new TestEmail());
});

// Webhooks
Route::withoutMiddleware('web')->group(function()
{
    // Tenant Payment Webhooks
    Route::post('webhooks/tenant-payments/{tenant}/{order}/{provider}', [PaymentWebhookController::class, 'handler'])
    ->name('tenant.payment-webhook');

    // Tenant Invoices Webhooks
    Route::post('webhooks/tenant-invoices', [InvoiceWebhookController::class, 'handler'])
    ->name('tenant.invoice-webhook');

    // Tenant Shipping Webhooks
    Route::post('webhooks/tenant-shippings/{tenant}/{orderShipping}/{provider}', [ShippingWebhookController::class, 'handler'])
    ->name('tenant.shipping-webhook');

    Route::post('webhooks/tenant-shippings/{tenant}/envia', [ShippingWebhookController::class, 'envia'])
    ->name('tenant.shipping-webhook.envia');
});

// SUPERADMIN ROUTES
Route::prefix('superadmin')->group(function() 
{
    Route::middleware('guest:superadmin')->group(function() {

        Route::view('/', 'superadmin.login')->name('superadmin.login-view');

        Route::post('login', [AuthController::class, 'login'])->name('superadmin.login');

    });

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