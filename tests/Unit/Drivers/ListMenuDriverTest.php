<?php namespace Tests\Belt\Menu\Unit\Drivers;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Lyst;
use Belt\Menu\Drivers\ListMenuDriver;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;

class ListMenuDriverTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Drivers\ListMenuDriver::add
     */
    public function test()
    {

        $list = m::mock(Lyst::class);
        $list->shouldReceive('getAttribute')->with('default_url')->andReturn('/lists/some-list');

        $menuItem = m::mock(MenuItem::class);
        $menuItem->shouldReceive('getAttribute')->with('slug')->andReturn('some-list');
        $menuItem->shouldReceive('getAttribute')->with('label')->andReturn('Some List');
        $menuItem->shouldReceive('getAttribute')->with('target')->andReturn(false);
        $menuItem->shouldReceive('morphParam')->once()->with('lists')->andReturn($list);

        $adapter = new ListMenuDriver($menuItem, ['config' => []]);
        $menuItem->adapter = $adapter;

        # add
        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with(
            '/lists/some-list',
            'Some List',
            ['name' => 'some-list'],
            ['target' => 'default'],
            $menuItem
        );
        $adapter->add($menuHelper);
    }


}