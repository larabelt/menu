<?php

use Belt\Menu\Facades\MenuFacade;
use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Menu as BeltMenu;

class MenuTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\Menu::get
     * @covers \Belt\Menu\Menu::create
     */
    public function test()
    {

        MenuFacade::macro('MenuTestMacro', function () {

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

        # get
        try {
            $beltMenu->get('UndefinedMenuTestMacro');
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }
        $this->assertNotNull($beltMenu->get('MenuTestMacro'));
        $this->assertNotNull($beltMenu->get('MenuTestMacro'));
        $this->assertNotNull($beltMenu->get('MenuTestMacro.products'));
    }

}