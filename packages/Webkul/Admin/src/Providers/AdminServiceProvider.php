<?php

namespace Webkul\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Webkul\Admin\Providers\EventServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Webkul\Admin\Exceptions\Handler;
use Illuminate\Foundation\AliasLoader;
use Webkul\Admin\Facades\Configuration as ConfigurationFacade;
use Webkul\Admin\Configuration;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'admin');

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('vendor/webkul/admin/assets'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'admin');

        $this->composeView();

        $this->app->register(EventServiceProvider::class);

        $this->app->bind(
            ExceptionHandler::class,
            Handler::class
        );
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Bind the the data to the views
     *
     * @return void
     */
    protected function composeView()
    {
        view()->composer(['admin::catalog.products.create', 'admin::catalog.products.edit'], function ($view) {
            $accordians = current(Event::fire('admin.catalog.products.accordian.create'));

            $view->with('form_accordians', $accordians);
        });

        view()->composer(['admin::layouts.nav-left', 'admin::layouts.nav-aside', 'admin::layouts.tabs'], function ($view) {
            $menu = current(Event::fire('admin.menu.create'));

            $menu->items = core()->sortItems($menu->items);

            $view->with('menu', $menu);
        });

        view()->composer(['admin::layouts.nav-aside', 'admin::layouts.tabs', 'admin::configuration.index'], function ($view) {
            $tree = current(Event::fire('admin.config.create'));

            $tree->items = core()->sortItems($tree->items);

            $view->with('config', $tree);
        });
    }
    
    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php', 'acl'
        );
    }
}