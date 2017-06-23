<?php

use Belt\Menu\Http\Requests\StoreMenuGroup;

class StoreMenuGroupTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Menu\Http\Requests\StoreMenuGroup::rules
     */
    public function test()
    {

        $request = new StoreMenuGroup();

        $this->assertNotEmpty(is_array($request->rules()));
    }

}