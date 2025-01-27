<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\DiscountOrderStock;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Observers\CategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;

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
            SendOrderCreatedNotification::class,
            DiscountOrderStock::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Order::observe(OrderObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
