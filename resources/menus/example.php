<?php

use Ohio\Menu\Menu;
use Ohio\Menu\Link;
use Ohio\Content\Page;

Menu::macro('example', function () {

    # Init
    $menu = Menu::new()
        ->add(Link::to('/', 'Home'))
        ->add(Link::to('/about', 'About'));

    # Services
    $menu->add(Menu::new()
        ->prepend(Link::to('/page/sectioned', 'Services'))
        ->link('/page/sectioned/fixing', 'Fixing')
        ->link('/page/sectioned/tweaking', 'Tweaking')
        ->link('/page/sectioned/preview', 'Not Floundering')
    );

    # Products
    $menu->add(Menu::new()
        ->prepend(Link::to('/products', 'Products'))
        ->add(Menu::new()
            ->prepend(Link::to('/products/widgets', 'Widgets'))
            ->link('/products/widgets/large', 'Large Widgets')
            ->link('/products/widgets/small', 'Small Widgets')
        )
        ->add(Menu::new()
            ->prepend(Link::to('/products/tools', 'Tools'))
            ->link('/products/tools/long', 'Long Tools')
            ->link('/products/tools/short', 'Short Tools')
            ->link('/products/tools/weird', 'Weird Tools')
        )
    );

    # Pages
    $qb = Page::orderBy('id')->take(5);
    $subMenu = Menu::new()->prepend('Pages');
    foreach ($qb->get() as $page) {
        $subMenu->link("/page/$page->slug", $page->name);
    };
    $menu->add($subMenu);

    # Contact
    $menu->add(Link::to('/contact', 'Contact'));;

    return $menu;
});