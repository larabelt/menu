<?php

use Belt\Menu\Facades\MenuFacade;
use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Menu as BeltMenu;
use Belt\Menu\MenuHelper;

class MenuHelperTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\MenuHelper::__construct
     * @covers \Belt\Menu\MenuHelper::__toString
     * @covers \Belt\Menu\MenuHelper::menu
     * @covers \Belt\Menu\MenuHelper::submenu
     * @covers \Belt\Menu\MenuHelper::items
     * @covers \Belt\Menu\MenuHelper::add
     * @covers \Belt\Menu\MenuHelper::active
     * @covers \Belt\Menu\MenuHelper::breadcrumbs
     * @covers \Belt\Menu\MenuHelper::render
     */
    public function test()
    {

        MenuFacade::macro('MenuHelperTestMacro', function () {

            $menu = Menu::create('test');
            $menu->add('/', 'Home');
            $menu->add('/about', 'About');

            # products submenu
            $submenu = $menu->add('/products', 'Products');
            $submenu->add(function ($menu) {
                $menu->add('/products/widgets', 'Widgets');
                $menu->add('/products/widgets/large', 'Large Widgets');
                $menu->add('/products/widgets/small', 'Small Widgets');
            });

            return $menu;
        });

        $beltMenu = new BeltMenu();

        # construct
        # add
        $menuHelper = $beltMenu->get('MenuHelperTestMacro');

        # menu
        # submenu
        $this->assertInstanceOf(\Knp\Menu\MenuItem::class, $menuHelper->menu());
        $this->assertInstanceOf(MenuHelper::class, $menuHelper->submenu('products'));

        # active
        $this->assertNull($menuHelper->active('/missing'));
        $this->assertInstanceOf(\Knp\Menu\MenuItem::class, $menuHelper->active('/products/widgets/small'));

        # items
        $this->assertNotEmpty($menuHelper->items());

        # breadcrumbs
        $this->assertNotEmpty($menuHelper->breadcrumbs());

        # render
        # toString
        $this->assertTrue(str_contains($menuHelper->__toString(), '<ul'));

    }

}