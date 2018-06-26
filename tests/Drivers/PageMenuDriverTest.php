<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Page;
use Belt\Menu\Drivers\PageMenuDriver;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;

class PageMenuDriverTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Drivers\PageMenuDriver::add
     */
    public function test()
    {

        $page = m::mock(Page::class);
        $page->shouldReceive('getAttribute')->with('default_url')->andReturn('/pages/some-page');

        $menuItem = m::mock(MenuItem::class);
        $menuItem->shouldReceive('getAttribute')->with('label')->andReturn('Some Page');
        $menuItem->shouldReceive('getAttribute')->with('target')->andReturn(false);
        $menuItem->shouldReceive('morphParam')->once()->with('pages')->andReturn($page);

        $adapter = new PageMenuDriver($menuItem, ['config' => []]);
        $menuItem->adapter = $adapter;

        # add
        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with('/pages/some-page', 'Some Page', [], ['target' => 'default']);
        $adapter->add($menuHelper);
    }


}