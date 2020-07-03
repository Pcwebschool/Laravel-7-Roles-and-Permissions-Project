<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('role', function ($roles) {
            return "<?php if(auth()->check() && auth()->user()->hasRole($roles)) : ?>"; //return this if statement inside php tag
        });

        Blade::directive('endrole', function ($roles) {
            return "<?php endif; ?>"; //return this endif statement inside php tag
        });
    }
}
