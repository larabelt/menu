<?php

use Belt\Menu\Http\Requests\UpdateMenuGroup;

class UpdateMenuGroupTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Menu\Http\Requests\UpdateMenuGroup::rules
     */
    public function test()
    {

        $request = new UpdateMenuGroup();

        $this->assertNotEmpty(is_array($request->rules()));
    }

}