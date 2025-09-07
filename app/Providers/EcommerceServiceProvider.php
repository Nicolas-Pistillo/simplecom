<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductCollection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View as FacadeView;
use Illuminate\View\View as View;

class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FacadeView::composer(['layouts.ecommerce', 'ecommerce.*'], function(View $view) 
        {
            $view->with('principal_categories', Category::principal()->orderBy('order')->published()->get());
            $view->with('featured_categories', Category::featured()->orderBy('order')->published()->get());
            $view->with('brands', Brand::published()->orderBy('name')->get());
            $view->with('product_collections', ProductCollection::where('active', true)->orderBy('name')->get());
        });
    }
}
