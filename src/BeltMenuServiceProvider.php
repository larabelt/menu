<?php

namespace Belt\Menu;

use Belt;
use Belt\Menu\Services\MenuService;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class BeltMenuServiceProvider
 * @package Belt\Menu
 */
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
        include __DIR__ . '/../routes/admin.php';
        include __DIR__ . '/../routes/api.php';
        include __DIR__ . '/../routes/web.php';

        # beltable values for global belt command
        $this->app['belt']->addPackage('menu', ['dir' => __DIR__ . '/..']);
        $this->app['belt']->publish('belt-menu:publish');
        $this->app['belt']->seeders('BeltMenuSeeder');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GateContract $gate, Router $router)
    {

        // set view paths
        // $this->loadViewsFrom(resource_path('belt/menu/views'), 'belt-menu');

        // set backup view paths
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'belt-menu');

        // set backup translation paths
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'belt-menu');

        // policies
        $this->registerPolicies($gate);

        // morphMap
        Relation::morphMap([
            'menu_groups' => Belt\Menu\MenuGroup::class,
            'menu_items' => Belt\Menu\MenuItem::class,
        ]);

        // commands
        $this->commands(Belt\Menu\Commands\BuildCommand::class);
        $this->commands(Belt\Menu\Commands\PublishCommand::class);

        // route model binding
        $router->bind('menu_group', function ($value) {
            return Belt\Menu\MenuGroup::sluggish($value)->first();
        });
        $router->model('menu_item', Belt\Menu\MenuItem::class);

        // add alias/facade
        $loader = AliasLoader::getInstance();
        $loader->alias('Menu', Belt\Menu\Facades\MenuFacade::class);

        // bind for facade
        $this->app->bind('menu', function ($app) {
            return new Belt\Menu\Menu();
        });

        // load menus from files
        foreach (config('belt.menu.menus', []) as $key => $config) {
            $path = array_get($config, 'path');
            if ($path && file_exists($path)) {
                include $path;
            }
        }

        # beltable values for global belt command
        $this->app['belt']->publish('belt-menu:publish');
        $this->app['belt']->seeders('BeltMenuSeeder');

        // access map for window config
        Belt\Core\Services\AccessService::put('*', 'menu_groups');
        Belt\Core\Services\AccessService::put('*', 'menu_items');
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