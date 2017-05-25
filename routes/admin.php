<?php

Route::group([
    'prefix' => 'admin/belt/menu',
    'middleware' => ['web', 'auth']
],
    function () {

        # admin/belt/content home
        Route::get('{any?}', function () {
            return view('belt-menu::base.admin.dashboard');
        })->where('any', '(.*)');

    }
);