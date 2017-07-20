<?php

use Belt\Menu\Http\Requests\UpdateMenuItem;

class UpdateMenuItemTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Menu\Http\Requests\UpdateMenuItem::rules
     */
    public function test()
    {

        $request = new UpdateMenuItem();

        $this->assertTrue(is_array($request->rules()));
    }

}