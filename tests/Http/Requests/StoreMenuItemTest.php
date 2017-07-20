<?php

use Belt\Menu\Http\Requests\StoreMenuItem;

class StoreMenuItemTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Menu\Http\Requests\StoreMenuItem::rules
     */
    public function test()
    {

        $request = new StoreMenuItem();

        $this->assertTrue(is_array($request->rules()));
    }

}