<?php namespace Tests\Belt\Menu\Unit\Resources\Subtypes;

use Belt\Core\Tests\BeltTestCase;
use Belt\Menu\Resources\Subtypes\BaseMenuItem;

class SubtypesBaseMenuItemTest extends BeltTestCase
{

    /**
     * @covers \Belt\Menu\Resources\Subtypes\BaseMenuItem::toArray
     */
    public function test()
    {
        $subtype = new BaseMenuItem();
        $subtype->setLabel('foo');
        $this->assertEquals('foo', array_get($subtype->toArray(), 'label'));
    }

}