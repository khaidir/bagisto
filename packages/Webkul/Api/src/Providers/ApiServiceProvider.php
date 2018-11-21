<?php

namespace Webkul\Api\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';
    }

    /**
    * Register services.
    *
    * @return void
    */
    public function register()
    {
    }
}