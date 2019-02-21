<?php namespace Tests\Belt\Menu\Unit\Drivers;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Menu\Drivers\DefaultMenuDriver;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;

class DefaultMenuDriverTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Drivers\DefaultMenuDriver::add
     */
    public function test()
    {
        $menuItem = m::mock(MenuItem::class);
        $menuItem->shouldReceive('getAttribute')->with('slug')->andReturn('some-test');
        $menuItem->shouldReceive('getAttribute')->with('url')->andReturn('http://test.com');
        $menuItem->shouldReceive('getAttribute')->with('label')->andReturn('Some Test');
        $menuItem->shouldReceive('getAttribute')->with('target')->andReturn('_blank');

        $adapter = new DefaultMenuDriver($menuItem, ['config' => []]);
        $menuItem->adapter = $adapter;

        # add
        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with(
            'http://test.com',
            'Some Test',
            ['name' => 'some-test'],
            ['target' => '_blank'],
            $menuItem
        );
        $adapter->add($menuHelper);
    }


}