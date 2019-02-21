<?php namespace Tests\Belt\Menu\Unit;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Menu\Menu as BeltMenu;
use Belt\Menu\MenuGroup;
use Belt\Menu\MenuItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MenuTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Menu::__construct
     * @covers \Belt\Menu\Menu::create
     * @covers \Belt\Menu\Menu::load
     * @covers \Belt\Menu\Menu::add
     * @covers \Belt\Menu\Menu::get
     * @covers \Belt\Menu\Menu::getMenu
     * @covers \Belt\Menu\Menu::getSubMenu
     */
    public function test()
    {

        # macros
        $beltMenu = new BeltMenu();
        $beltMenu->macro('MenuTestMacro', function () {

            $beltMenu = new BeltMenu();

            $menu = $beltMenu->create('test');
            $menu->add('/', 'Home');
            $menu->add('/about', 'About');

            # products submenu
            $submenu = $menu->add('/products', 'Products');
            $submenu->add(function ($menu) {
                $menu->add('/products/widgets', 'Widgets');
                $menu->add('/products/widgets/large', 'Large Widgets');
                $menu->add('/products/widgets/small', 'Small Widgets');
            });

            return $menu;
        });
        //dump($beltMenu::$macros);

        # construct
        $beltMenu = new BeltMenu();
        $this->assertInstanceOf(MenuGroup::class, $beltMenu->menuGroup);

        # load
        $menuGroup = factory(MenuGroup::class)->make();
        $menuGroup->menuItems = new Collection();
        $menuItem = factory(MenuItem::class)->make();
        $menuItem->children = new Collection();
        $menuGroup->menuItems->push($menuItem);
        $beltMenu->load($menuGroup);

        # get (exception)
        $beltMenu = new BeltMenu();
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('sluggish')->with('UndefinedMenuTestMacro')->andReturnSelf();
        $qb->shouldReceive('first')->andReturn(false);
        $beltMenu->menuGroup = $qb;
        try {
            $beltMenu->get('UndefinedMenuTestMacro');
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }

        # get submenu (exception)
        $beltMenu = new BeltMenu();
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('sluggish')->with('MenuTestMacro.undefined')->andReturnSelf();
        $qb->shouldReceive('first')->andReturn(false);
        $beltMenu->menuGroup = $qb;
        try {
            $beltMenu->get('MenuTestMacro.undefined');
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }

        # get (hard-coded)
        $this->assertNotNull($beltMenu->get('MenuTestMacro'));

        # get (submenu)
        $this->assertNotNull($beltMenu->get('MenuTestMacro.products'));

        # get (db)
        $beltMenu = new BeltMenu();
        $menuGroup = factory(MenuGroup::class)->make(['slug' => 'db-menu']);
        $menuGroup->menuItems = new Collection();
        $menuItem = factory(MenuItem::class)->make();
        $menuItem->children = new Collection();
        $menuGroup->menuItems->push($menuItem);
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('sluggish')->with('db-menu')->andReturnSelf();
        $qb->shouldReceive('first')->andReturn($menuGroup);
        $beltMenu->menuGroup = $qb;
        $this->assertNotNull($beltMenu->get('db-menu'));

        # add
        $beltMenu = new BeltMenu();
        MenuItem::unguard();
        $parent = factory(MenuItem::class)->make(['url' => '/parent']);
        $parent->children = new Collection();
        $this->child($parent);
        $this->child($parent);
        $this->child($parent);
        $menu = $beltMenu->create('test');
        $beltMenu->add($menu, $parent);
    }

    private function child($parent)
    {
        $child = factory(MenuItem::class)->make();
        $child->children = new Collection();

        $parent->children->push($child);
    }

}