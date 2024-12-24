<?php

declare(strict_types=1);

use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\Tenant\PaymentReturnController;
use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\EcommerceController;
use App\Http\Controllers\Tenant\SocialiteController;
use App\Models\Product;
use App\Services\PaymentProviders\Modo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::view('test', 'ecommerce.thanks');

    /*****  TENANT ECOMMERCE ROUTES  *****/
    Route::middleware(['tenant_setuped', 'tenant_active'])->group(function() {

        // SSO user login and registration
        Route::get('sso/{provider}/redirect', [SocialiteController::class, 'redirect']);
        Route::get('sso/{provider}/callback', [SocialiteController::class, 'callback']);

        // Payment providers urls
        Route::get('payment-providers/{provider}/return', [PaymentReturnController::class, 'handler'])
            ->name('payment.return');

        Route::post('payment-providers/{provider}/webhook', [PaymentWebhookController::class, 'handler'])
            ->name('payment.webhook');

        Route::post('payment-providers/modo-payment-intention', function() 
        {
            $modo = new Modo();
            $modo->generateCheckout([]);

            return response()->json($modo->frontend_payload);
        })->name('modo.payment-intention');

        // Ecommerce navigation
        Route::get('/', [EcommerceController::class, 'index'])->name('ecommerce.index');

        Route::get('productos', [EcommerceController::class, 'products'])->name('ecommerce.products');

        Route::get('productos/{productName}/{product}', [EcommerceController::class, 'productDetail'])
            ->name('ecommerce.product-detail');

        Route::get('checkout', [EcommerceController::class, 'checkout'])->name('ecommerce.checkout');

        Route::get('sobre-nosotros', [EcommerceController::class, 'about'])->name('ecommerce.about');

        Route::get('contacto', [EcommerceController::class, 'contact'])->name('ecommerce.contact');

        // Auth customer routes
        Route::middleware('auth')->group(function() 
        {
            Route::post('logout', function() {
                Auth::logout();
                return back()->with('logout_message', true);
            })->name('customer.logout');
        });

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

                Route::view('configurations', 'admin.configurations.index')
                    ->name('admin.configurations.index')
                    ->middleware('can:Editar configuraciones');

                Route::view('categories', 'admin.categories.index')
                    ->name('admin.categories.index')
                    ->middleware('can:Editar categorias');

                Route::view('brands', 'admin.brands.index')
                    ->name('admin.brands.index')
                    ->middleware('can:Editar marcas');

                Route::view('operators', 'admin.operators.index')
                    ->name('admin.operators.index')
                    ->middleware('can:Editar operadores');

                Route::view('banners', 'admin.contents.banners')
                    ->name('admin.contents.banners')
                    ->middleware('can:Editar banners');

                Route::view('attributes', 'admin.attributes.index')
                    ->name('admin.attributes.index')
                    ->middleware('can:Editar atributos');

                Route::view('payment-methods', 'admin.payment-methods.index')
                    ->name('admin.payment-methods.index')
                    ->middleware('can:Editar formas de pago');

                Route::view('delivery-methods', 'admin.delivery-methods.index')
                    ->name('admin.delivery-methods.index')
                    ->middleware('can:Editar formas de entrega');

                Route::view('products', 'admin.products.index')
                    ->name('admin.products.index')
                    ->middleware('can:Editar productos');

                Route::view('products/create', 'admin.products.upsert')
                    ->name('admin.products.create')
                    ->middleware('can:Editar productos');

                Route::get('products/{product}/edit', function(Product $product) {
                    return view('admin.products.upsert', compact('product'));
                })->name('admin.products.edit')->middleware('can:Editar productos'); 

            });

        });

    });
});
