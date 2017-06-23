<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Facades\MenuFacade;
use Belt\Menu\Menu as BeltMenu;
use Belt\Menu\MenuGroup;
use Belt\Menu\MenuItem;
use Belt\Menu\Services\MenuService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class MenuServiceTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Services\MenuService::__construct
     * @covers \Belt\Menu\Services\MenuService::build
     * @covers \Belt\Menu\Services\MenuService::__build
     */
    public function test()
    {
        # construct
        $service = new MenuService();
        $this->assertInstanceOf(BeltMenu::class, $service->menu);
        $this->assertInstanceOf(MenuGroup::class, $service->menuGroup);
        $this->assertInstanceOf(MenuItem::class, $service->menuItem);

        BeltMenu::macro('loaded', function () {
            return true;
        });

        BeltMenu::macro('hard-coded', function () {

            $menu = (new BeltMenu())->create('test');
            $menu->add('/', 'Home');
            $menu->add('/about', 'About');

            # products submenu
            $submenu = $menu->add('/products', 'Products', [], ['target' => '_blank']);
            $submenu->add(function ($menu) {
                $menu->add('/products/widgets', 'Widgets'); // relative with leading slash, should ignore prefix
                $menu->add('widgets/large', 'Large Widgets'); // relative without leading slash, should get prefix
                $menu->add('widgets/small', 'Small Widgets'); // relative without leading slash, should get prefix
            });

            return $menu;
        });

        # build (existing)
        $service = new MenuService();
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('sluggish')->with('existing')->andReturnSelf();
        $qb->shouldReceive('first')->andReturn(new MenuGroup());
        $service->menuGroup = $qb;
        $service->build('existing');

        # build (not-hard-coded)
        $service = new MenuService();
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('sluggish')->with('not-hard-coded')->andReturnSelf();
        $qb->shouldReceive('first')->andReturn(false);
        $service->menuGroup = $qb;
        $beltMenu = m::mock(BeltMenu::class);
        $beltMenu->shouldReceive('get')->with('not-hard-coded')->andReturn(false);
        $service->menu = $beltMenu;
        $service->build('not-hard-coded');

        # build (hard-coded)
        $menuGroup = factory(MenuGroup::class)->make(['slug' => 'db-menu']);
        $menuGroup->menuItems = new Collection();
        $menuItem = factory(MenuItem::class)->make();
        $menuItem->children = new Collection();
        $menuGroup->menuItems->push($menuItem);

        $service = new MenuService();
        $menuGroupQB = m::mock(Builder::class);
        $menuGroupQB->shouldReceive('sluggish')->with('hard-coded')->andReturnSelf();
        $menuGroupQB->shouldReceive('first')->andReturn(false);
        $menuGroupQB->shouldReceive('create')->andReturn($menuGroup);
        $service->menuGroup = $menuGroupQB;
        $menuItemQB = m::mock(Builder::class);
        $menuItemQB->shouldReceive('create')->andReturn($menuItem);
        $service->menuItem = $menuItemQB;
        $service->build('hard-coded');

    }

    private function child($parent)
    {
        $child = factory(MenuItem::class)->make();
        $child->children = new Collection();

        $parent->children->push($child);
    }

}

