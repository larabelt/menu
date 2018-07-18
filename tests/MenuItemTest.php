<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Drivers\BaseMenuDriver;
use Belt\Menu\Drivers\DefaultMenuDriver;
use Belt\Menu\MenuItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItemTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\MenuItem::setUrlAttribute
     * @covers \Belt\Menu\MenuItem::getUrlAttribute
     * @covers \Belt\Menu\MenuItem::getLabelAttribute
     * @covers \Belt\Menu\MenuItem::menuGroup
     * @covers \Belt\Menu\MenuItem::children
     * @covers \Belt\Menu\MenuItem::adapter
     * @covers \Belt\Menu\MenuItem::initAdapter
     */
    public function test()
    {
        $menuItem = factory(MenuItem::class)->make([
            'driver' => 'test',
            'url' => 'http://Google.com',
        ]);

        # toArray
        $this->assertNotEmpty($menuItem->toArray());

        # url
        $menuItem->url = 'http://TEST.com';
        $this->assertEquals('http://TEST.com', $menuItem->url);

//        # label
//        $menuItem->label = 'test';
//        $this->assertEquals('test', $menuItem->label);

        # menuGroup
        $this->assertInstanceOf(BelongsTo::class, $menuItem->menuGroup());

        # children
        $this->assertInstanceOf(HasMany::class, $menuItem->children());

        # adapter
        $this->assertInstanceOf(BaseMenuDriver::class, $menuItem->adapter());

    }

    /**
     * @covers \Belt\Menu\MenuItem::getUrlAttribute
     * @covers \Belt\Menu\MenuItem::getLabelAttribute
     */
    public function testAltDriver()
    {
        MenuItem::unguard();

        $menuItem = new MenuItem(['template' => 'foo']);

        app()['config']->set('belt.templates.menu_items.foo', [
            'driver' => MenuItemTestMenuDriver::class,
        ]);

        # url
        $this->assertEquals('http://test.com', $menuItem->url);

        # label
        $this->assertEquals('test', $menuItem->label);

    }

}

class MenuItemTestMenuDriver extends DefaultMenuDriver
{

    public function label()
    {
        return 'test';
    }

    public function url()
    {
        return 'http://test.com';
    }
}

class MenuItemTestMenuItem extends MenuItem
{

}