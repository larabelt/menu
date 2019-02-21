<?php namespace Tests\Belt\Menu\Unit\Http\Requests;

use Belt\Menu\Http\Requests\StoreMenuItem;

class StoreMenuItemTest extends \PHPUnit\Framework\TestCase
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