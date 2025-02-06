<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\View as FacadeView;
use Illuminate\View\View as View;

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
        FacadeView::composer(['layouts.ecommerce', 'ecommerce.*'], function(View $view) 
        {
            $view->with('principal_categories', Category::principal()->orderBy('name')->published()->get());
        });
    }
}
