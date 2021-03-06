<?php namespace Tests\Belt\Menu\Unit\Drivers;

use Belt\Core\Tests\BeltTestCase;
use Belt\Menu\Drivers\DefaultMenuDriver;
use Belt\Menu\MenuItem;

class BaseMenuDriverTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\Drivers\BaseMenuDriver::__construct
     * @covers \Belt\Menu\Drivers\BaseMenuDriver::label
     * @covers \Belt\Menu\Drivers\BaseMenuDriver::label
     * @covers \Belt\Menu\Drivers\BaseMenuDriver::url
     */
    public function test()
    {
        $menuItem = factory(MenuItem::class)->make([
            'driver' => 'test',
            'url' => 'http://Google.com',
        ]);

        $config = [];

        $adapter = new DefaultMenuDriver($menuItem, ['config' => $config]);

        # label
        $this->assertEquals('', $adapter->label());

        # url
        $this->assertEquals('', $adapter->url());
    }


}