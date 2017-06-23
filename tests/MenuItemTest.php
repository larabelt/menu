<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\MenuGroup;
use Belt\Menu\MenuItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MenuItemTest extends BeltTestCase
{
    /**
     * @covers \Belt\Menu\MenuItem::setUrlAttribute
     * @covers \Belt\Menu\MenuItem::menuGroup
     * @covers \Belt\Menu\MenuItem::children
     * @covers \Belt\Menu\MenuItem::menuable
     */
    public function test()
    {
        $menuItem = factory(MenuItem::class)->make(['url' => 'http://Google.com']);

        # toArray
        $this->assertNotEmpty($menuItem->toArray());

        # setUrlAttribute
        $this->assertEquals('http://google.com', $menuItem->url);

        # menuGroup
        $this->assertInstanceOf(BelongsTo::class, $menuItem->menuGroup());

        # menuable
        $this->assertInstanceOf(MorphTo::class, $menuItem->menuable());

        # children
        $this->assertInstanceOf(HasMany::class, $menuItem->children());
    }

}