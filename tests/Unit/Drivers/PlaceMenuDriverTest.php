<?php namespace Tests\Belt\Menu\Unit\Drivers;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Spot\Place;
use Belt\Menu\Drivers\PlaceMenuDriver;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;

class PlaceMenuDriverTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Drivers\PlaceMenuDriver::add
     */
    public function test()
    {

        $place = m::mock(Place::class);
        $place->shouldReceive('getAttribute')->with('default_url')->andReturn('/places/some-place');

        $menuItem = m::mock(MenuItem::class);
        $menuItem->shouldReceive('getAttribute')->with('slug')->andReturn('some-place');
        $menuItem->shouldReceive('getAttribute')->with('label')->andReturn('Some Place');
        $menuItem->shouldReceive('getAttribute')->with('target')->andReturn(false);
        $menuItem->shouldReceive('morphParam')->once()->with('places')->andReturn($place);

        $adapter = new PlaceMenuDriver($menuItem, ['config' => []]);
        $menuItem->adapter = $adapter;

        # add
        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with(
            '/places/some-place',
            'Some Place',
            ['name' => 'some-place'],
            ['target' => 'default'],
            $menuItem
        );
        $adapter->add($menuHelper);
    }


}