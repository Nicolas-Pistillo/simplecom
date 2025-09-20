<?php

namespace App\Providers;

use App\Livewire\Admin\DeliveryMethods\CustomShippings\Index;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Livewire::forceAssetInjection();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('admin.delivery-methods.custom-shippings.index', Index::class);
    }
}
