<?php

use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\AuthController;
use App\Http\Controllers\Superadmin\TenantController;
use App\Http\Controllers\Tenant\PaymentWebhookController;
use App\Http\Controllers\Tenant\InvoiceWebhookController;
use App\Http\Controllers\Tenant\ShippingWebhookController;
use App\Models\Message;
use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('simplecom.landing');

/* Route::get('test-email', function() {
    $tenant = Tenant::first();

    tenancy()->initialize($tenant);

    $message = Message::first();

    return view('mail.message-replied', compact('tenant', 'message'));
});
 */
// Webhooks
Route::withoutMiddleware('web')->group(function()
{
    // Tenant Payment Webhooks
    Route::post('webhooks/tenant-payments/{tenant}/{order}/{provider}', [PaymentWebhookController::class, 'handler'])
    ->name('tenant.payment-webhook');

    // Nave Webhook
    Route::post('webhooks/tenant-payments/nave', [PaymentWebhookController::class, 'nave'])
    ->name('tenant.nave-webhook');

    // Stripe Webhook
    Route::post('webhooks/tenant-payments/{tenant}/stripe', [PaymentWebhookController::class, 'stripe'])
    ->name('tenant.stripe-webhook');

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

        Route::get('dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard.index');

        Route::view('tenants', 'superadmin.tenants.index')->name('superadmin.tenants.index');

        Route::view('tenants/create', 'superadmin.tenants.create')->name('superadmin.tenants.create');

        Route::view('tenants/{tenant}/edit', 'superadmin.tenants.edit')->name('superadmin.tenants.edit');

        /* Route::prefix('dashboard')->group(function() {

            Route::get('/', [DashboardController::class, 'index'])->name('superadmin.dashboard.index');

            // Tenants management
            Route::view('tenants', 'superadmin.tenants.index')->name('superadmin.tenants.index');

            Route::view('tenants/create', 'superadmin.tenants.create')->name('superadmin.tenants.create');

            Route::view('tenants/{tenant}/edit', 'superadmin.tenants.edit')->name('superadmin.tenants.edit');
        }); */

    });
});