<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\MenuGroup;

class MenuGroupTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\MenuGroup::__toString
     * @covers \Belt\Content\MenuGroup::setTemplateAttribute
     * @covers \Belt\Content\MenuGroup::setBodyAttribute
     */
    public function test()
    {
        $menuGroup = factory(MenuGroup::class)->make();
        $menuGroup->name = ' Test ';
        $menuGroup->body = ' Test ';

        $this->assertEquals($menuGroup->name, $menuGroup->__toString());
        $this->assertEquals('Test', $menuGroup->body);
    }

}