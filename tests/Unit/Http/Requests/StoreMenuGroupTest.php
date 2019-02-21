<?php namespace Tests\Belt\Menu\Unit\Http\Requests;

use Belt\Menu\Http\Requests\StoreMenuGroup;

class StoreMenuGroupTest extends \PHPUnit\Framework\TestCase
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