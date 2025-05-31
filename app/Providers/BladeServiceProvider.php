<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blade::directive('config', function ($expression) 
        {
            $key = trim($expression, "'\"");

            return "<?php 
                \$value = \App\Models\Configuration::where('key', '{$key}')->first()?->value;
                
                if (!empty(\$value) && \$value !== ''): ?>";
        });

        Blade::directive('endconfig', function () {
            return "<?php endif; ?>";
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
