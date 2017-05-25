<?php

use Belt\Menu\Http\Controllers\Api;

Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {

        # menu-items
        Route::group([
            'prefix' => 'menu-groups/{menu_group}/menu-items'
        ], function () {
            Route::get('{menu_item}', Api\MenuItemsController::class . '@show');
            Route::put('{menu_item}', Api\MenuItemsController::class . '@update');
            Route::delete('{menu_item}', Api\MenuItemsController::class . '@destroy');
            Route::get('', Api\MenuItemsController::class . '@index');
            Route::post('', Api\MenuItemsController::class . '@store');
        });

        # menu-groups
        Route::get('menu-groups/{menu_group}', Api\MenuGroupsController::class . '@show');
        Route::put('menu-groups/{menu_group}', Api\MenuGroupsController::class . '@update');
        Route::delete('menu-groups/{menu_group}', Api\MenuGroupsController::class . '@destroy');
        Route::get('menu-groups', Api\MenuGroupsController::class . '@index');
        Route::post('menu-groups', Api\MenuGroupsController::class . '@store');

    }
);
