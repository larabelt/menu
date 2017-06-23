<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\MenuGroup;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuGroupTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\MenuGroup::menuItems
     */
    public function test()
    {
        $menuGroup = factory(MenuGroup::class)->make();

        $this->assertInstanceOf(HasMany::class, $menuGroup->menuItems());
    }

}