<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;

Menu::macro('example', function () {

    $menu = Menu::new()
        ->add(Link::to('/', 'Home'))
        ->add(Link::to('/about', 'About'))
        ->add(Link::to('/contact', 'Contact'))
        ->add(Menu::new()
            ->prepend(Link::to('/foo', 'Foo'))
            ->link('/basic-usage/your-first-menu', 'Your First Menu 111')
            ->link('/basic-usage/adding-submenus', 'Adding Submenus')
        );

    return $menu;
});