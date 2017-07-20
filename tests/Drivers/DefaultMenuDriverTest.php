<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
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
        $menuItem = factory(MenuItem::class)->make([
            'label' => 'test',
            'url' => 'http://test.com',
        ]);

        $config = [];

        $adapter = new DefaultMenuDriver($menuItem, ['config' => $config]);

        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with('http://test.com', 'test');

        # add
        $adapter->add($menuHelper);
    }


}