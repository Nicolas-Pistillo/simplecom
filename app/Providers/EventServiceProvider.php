<?php

namespace App\Providers;

use App\Events\OrderConfirmed;
use App\Events\OrderCreated;
use App\Events\OrderReadyForDispatch;
use App\Events\OrderReadyForPickup;
use App\Listeners\DiscountOrderStock;
use App\Listeners\SendOrderConfirmedNotification;
use App\Listeners\SendOrderCreatedNotification;
use App\Listeners\SendOrderReadyForDispatchNotification;
use App\Listeners\SendOrderReadyForPickupNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Observers\CategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\OrderPaymentObserver;
use App\Observers\ProductObserver;
use App\Observers\ProductVariantObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class => [
            SendOrderCreatedNotification::class
        ],
        OrderConfirmed::class => [
            DiscountOrderStock::class,
            SendOrderConfirmedNotification::class
        ],
        OrderReadyForPickup::class => [
            SendOrderReadyForPickupNotification::class
        ],
        OrderReadyForDispatch::class => [
            SendOrderReadyForDispatchNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        ProductVariant::observe(ProductVariantObserver::class);
        Order::observe(OrderObserver::class);
        OrderPayment::observe(OrderPaymentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
