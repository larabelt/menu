<?php

use Belt\Menu\Http\Controllers\Web;

Route::group(['middleware' => ['web']], function () {

    # menus
    Route::get('menus/{menu_group}', Web\MenusController::class . '@show');

});