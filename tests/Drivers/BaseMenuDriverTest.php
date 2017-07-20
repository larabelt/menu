<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Drivers\BaseMenuDriver;
use Belt\Menu\Menu;
use Belt\Menu\MenuItem;

class BaseMenuDriverTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\Drivers\BaseMenuDriver::__construct
     * @covers \Belt\Menu\Drivers\BaseMenuDriver::add
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

        $adapter = new BaseMenuDriver($menuItem, ['config' => $config]);

        $menuHelper = (new Menu())->create('test');

        # add
        $this->assertNotNull($adapter->add($menuHelper));

        # label
        $this->assertEquals('', $adapter->label());

        # url
        $this->assertEquals('', $adapter->url());
    }


}