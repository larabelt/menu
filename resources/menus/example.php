<?php

use Belt\Content\Page;

Menu::macro('example', function () {

    $menu = Menu::create('main');
    $menu->add('/', 'Home');
    $menu->add('/about', 'About');

    # services submenu
    $submenu = $menu->add('/page/sectioned', 'Services');
    $submenu->add(function ($menu) {
        $menu->add('/page/sectioned/fixing', 'Fixing');
        $menu->add('/page/sectioned/tweaking', 'Tweaking');
        $menu->add('/page/sectioned/preview', 'Not Floundering');
    });

    # products submenu
    $submenu = $menu->add('/products', 'Products');
    $submenu->add(function ($menu) {
        $menu->add('/products/widgets', 'Widgets');
        $menu->add('/products/widgets/large', 'Large Widgets');
        $menu->add('/products/widgets/small', 'Small Widgets');
    });

    # Pages
    $qb = Page::orderBy('id')->take(5);
    $submenu = $menu->add('/pages', 'Pages');
    foreach ($qb->get() as $page) {
        $submenu->add("/page/$page->slug", $page->name);
    };

    # Contact
    $menu->add('/contact', 'Contact');

    return $menu;
});