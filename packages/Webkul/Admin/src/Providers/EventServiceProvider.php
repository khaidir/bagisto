<?php

namespace Webkul\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Webkul\Ui\Menu;
use Webkul\Admin\ProductFormAccordian;
use Config;
use Webkul\User\Bouncer;

class EventServiceProvider extends ServiceProvider
{
    protected $menufield = [
        [
            'key' => 'dashboard',
            'name' => 'Dashboard',
            'route' => 'admin.dashboard.index',
            'sort' => 1,
            'icon-class' => 'dashboard-icon',
        ],
        [
            'key' => 'catalog',
            'name' => 'Catalog',
            'route' => 'admin.catalog.products.index',
            'sort' => 3,
            'icon-class' => 'catalog-icon',
        ],
        [
            'key' => 'catalog.products',
            'name' => 'Products',
            'route' => 'admin.catalog.products.index',
            'sort' => 1,
            'icon-class' => '',
        ],
        [
            'key' => 'catalog.categories',
            'name' => 'Categories',
            'route' => 'admin.catalog.categories.index',
            'sort' => 2,
            'icon-class' => '',
        ],
        [
            'key' => 'catalog.attributes',
            'name' => 'Attributes',
            'route' => 'admin.catalog.attributes.index',
            'sort' => 3,
            'icon-class' => '',
        ],
        [
            'key' => 'catalog.families',
            'name' => 'Families',
            'route' => 'admin.catalog.families.index',
            'sort' => 4,
            'icon-class' => '',
        ],
        [
            'key' => 'configuration',
            'name' => 'Configure',
            'route' => 'admin.account.edit',
            'sort' => 6,
            'icon-class' => 'configuration-icon',
        ],
        [
            'key' => 'configuration.account',
            'name' => 'My Account',
            'route' => 'admin.account.edit',
            'sort' => 1,
            'icon-class' => '',
        ],
        [
            'key' => 'settings',
            'name' => 'Settings',
            'route' => 'admin.countries.index',
            'sort' => 6,
            'icon-class' => 'settings-icon',
        ],
        [
            'key' => 'settings.countries',
            'name' => 'Countries',
            'route' => 'admin.countries.index',
            'sort' => 1,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.locales',
            'name' => 'Locales',
            'route' => 'admin.locales.index',
            'sort' => 2,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.currencies',
            'name' => 'Currencies',
            'route' => 'admin.currencies.index',
            'sort' => 3,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.exchange_rates',
            'name' => 'Exchange Rates',
            'route' => 'admin.exchange_rates.index',
            'sort' => 4,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.inventory_sources',
            'name' => 'Inventory Sources',
            'route' => 'admin.inventory_sources.index',
            'sort' => 5,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.channels',
            'name' => 'Channels',
            'route' => 'admin.channels.index',
            'sort' => 6,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.users',
            'name' => 'Users',
            'route' => 'admin.users.index',
            'sort' => 7,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.users.users',
            'name' => 'Users',
            'route' => 'admin.users.index',
            'sort' => 1,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.users.roles',
            'name' => 'Roles',
            'route' => 'admin.roles.index',
            'sort' => 2,
            'icon-class' => '',
        ],
        [
            'key' => 'settings.sliders',
            'name' => 'Create Sliders',
            'route' => 'admin.sliders.index',
            'sort' => 8,
            'icon-class' => '',
        ],
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->createAdminMenu();

        $this->buildACL();

        $this->registerACL();

        $this->createProductFormAccordian();
    }

    /**
     * This method fires an event for menu creation, any package can add their menu item by listening to the admin.menu.build event
     *
     * @return void
     */
    public function createAdminMenu()
    {
        Event::listen('admin.menu.create', function () {
            return Menu::create(function ($menu) {
                Event::fire('admin.menu.build', $menu);
            });
        });

        Event::listen('admin.menu.build', function ($menu) {
            $items = Config::get('menu.menu');
            $acl = app('acl');
            foreach($this->menufield as $newmenu){
                if (bouncer()->hasPermission($newmenu['key'])){
                    $menu->add($newmenu['key'], $newmenu['name'], $newmenu['route'], $newmenu['sort'], $newmenu['icon-class']);
                }
            }
        });
    }

    /**
     * Build route based ACL
     *
     * @return voidbuildACL
     */
    public function buildACL()
    {
        Event::listen('admin.acl.build', function ($acl) {
            $items = Config::get('menu.acl');

            $acl->add('dashboard', 'Dashboard', 'admin.dashboard.index', 1);

            $acl->add('catalog', 'Catalog', 'admin.catalog.index', 2);

            $acl->add('catalog.products', 'Products', 'admin.catalog.products.index', 1);

            $acl->add('catalog.categories', 'Categories', 'admin.catalog.categories.index', 2);

            $acl->add('catalog.attributes', 'Attributes', 'admin.catalog.attributes.index', 3);

            $acl->add('catalog.families', 'Families', 'admin.catalog.families.index', 4);

            $acl->add('configuration', 'Configure', 'admin.account.edit', 3);

            $acl->add('configuration.my-account', 'My Account', 'admin.account.edit', 1);

            $acl->add('settings', 'Settings', 'admin.users.index', 4);

            $acl->add('settings.countries', 'Countries', 'admin.countries.index', 1);

            $acl->add('settings.locales', 'Locales', 'admin.locales.index', 2);

            $acl->add('settings.currencies', 'Currencies', 'admin.currencies.index', 3);

            $acl->add('settings.exchange-rates', 'Exchange Rates', 'admin.exchange_rates.index', 4);

            $acl->add('settings.inventory-sources', 'Inventory Sources', 'admin.inventory_sources.index', 5);

            $acl->add('settings.channels', 'Channels', 'admin.channels.index', 6);

            $acl->add('settings.users', 'Users', 'admin.users.index', 7);

            $acl->add('settings.users.users', 'Users', 'admin.users.index', 1, '');

            $acl->add('settings.users.roles', 'Roles', 'admin.roles.index', 2, '');

            $acl->add('settings.sliders', 'Create Slider', 'admin.sliders.index', 8);
        });
    }

    /**
     * Registers acl to entire application
     *
     * @return void
     */
    public function registerACL()
    {
        $this->app->singleton('acl', function () {
            return current(Event::fire('admin.acl.create'));
        });

        View::share('acl', app('acl'));
    }

    /**
     * This method fires an event for accordian creation, any package can add their accordian item by listening to the admin.catalog.products.accordian.build event
     *
     * @return void
     */
    public function createProductFormAccordian()
    {
        Event::listen('admin.catalog.products.accordian.create', function() {
            return ProductFormAccordian::create(function($accordian) {
                Event::fire('admin.catalog.products.accordian.build', $accordian);
            });
        });

        Event::listen('admin.catalog.products.accordian.build', function($accordian) {
            $accordian->add('inventories', 'Inventories', 'admin::catalog.products.accordians.inventories', 1);

            $accordian->add('images', 'Images', 'admin::catalog.products.accordians.images', 2);

            $accordian->add('categories', 'Categories', 'admin::catalog.products.accordians.categories', 3);

            $accordian->add('variations', 'Variations', 'admin::catalog.products.accordians.variations', 4);

            $accordian->add('links', 'Linked Products', 'admin::catalog.products.accordians.product-links', 5);
        });
    }
}
