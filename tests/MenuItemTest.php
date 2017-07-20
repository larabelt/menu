<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Drivers\BaseMenuDriver;
use Belt\Menu\Drivers\DefaultMenuDriver;
use Belt\Menu\MenuItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MenuItemTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\MenuItem::setUrlAttribute
     * @covers \Belt\Menu\MenuItem::getUrlAttribute
     * @covers \Belt\Menu\MenuItem::getLabelAttribute
     * @covers \Belt\Menu\MenuItem::menuGroup
     * @covers \Belt\Menu\MenuItem::children
     * @covers \Belt\Menu\MenuItem::menuable
     * @covers \Belt\Menu\MenuItem::configPath
     * @covers \Belt\Menu\MenuItem::defaultDriverClass
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
        $this->assertEquals('http://test.com', $menuItem->url);

        # label
        $menuItem->label = 'test';
        $this->assertEquals('test', $menuItem->label);

        # menuGroup
        $this->assertInstanceOf(BelongsTo::class, $menuItem->menuGroup());

        # menuable
        $this->assertInstanceOf(MorphTo::class, $menuItem->menuable());

        # children
        $this->assertInstanceOf(HasMany::class, $menuItem->children());

        # configPath
        $this->assertEquals('belt.menu.drivers.test', $menuItem->configPath());

        # defaultDriverClass
        $this->assertEquals(DefaultMenuDriver::class, $menuItem->defaultDriverClass());
    }

    /**
     * @covers \Belt\Menu\MenuItem::getUrlAttribute
     * @covers \Belt\Menu\MenuItem::getLabelAttribute
     */
    public function testAltDriver()
    {
        $menuItem = new MenuItemTestMenuItem();

        # url
        $this->assertEquals('http://test.com', $menuItem->url);

        # label
        $this->assertEquals('test', $menuItem->label);

    }

}

class MenuItemTestMenuDriver extends BaseMenuDriver
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
    public function defaultDriverClass()
    {
        return MenuItemTestMenuDriver::class;
    }
}