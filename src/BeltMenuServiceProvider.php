<?php

namespace Belt\Menu;

use Belt, Spatie;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class BeltMenuServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GateContract $gate, Router $router)
    {

        // set view paths
        $this->loadViewsFrom(resource_path('belt/menu/views'), 'belt-menu');

        // set backup view paths
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'belt-menu');

        // policies
        $this->registerPolicies($gate);

        // commands
        $this->commands(Belt\Menu\Commands\PublishCommand::class);

        // load other packages
        $this->app->register(Spatie\Menu\Laravel\MenuServiceProvider::class);

        $this->app->bind('menu', function ($app) {
            return new Belt\Menu\Menu();
        });

        // add other aliases
        $loader = AliasLoader::getInstance();
        $loader->alias('Menu', Belt\Menu\Facades\MenuFacade::class);

        // load menus
        foreach (config('belt.menu.menus', []) as $key => $config) {
            $path = array_get($config, 'path');
            if ($path && file_exists($path)) {
                include $path;
            }
        }
    }

    /**
     * Register the application's policies.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function registerPolicies(GateContract $gate)
    {
        foreach ($this->policies as $key => $value) {
            $gate->policy($key, $value);
        }
    }

}