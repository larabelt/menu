<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Facades\MenuFacade;

class MenuFacadeTest extends BeltTestCase
{

    /**
     * @covers \Belt\Menu\Facades\MenuFacade::getFacadeAccessor
     */
    public function test()
    {
        $facade = new MenuFacadeTestStub();

        $this->assertEquals('menu', $facade->testGetFacadeAccessor());
    }

}

class MenuFacadeTestStub extends MenuFacade
{
    public function testGetFacadeAccessor()
    {
        return static::getFacadeAccessor();
    }
}