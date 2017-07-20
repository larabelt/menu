<?php

use Mockery as m;
use Belt\Glue\Category;
use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\Drivers\CategoryMenuDriver;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class CategoryMenuDriverTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Drivers\CategoryMenuDriver::category
     * @covers \Belt\Menu\Drivers\CategoryMenuDriver::label
     * @covers \Belt\Menu\Drivers\CategoryMenuDriver::url
     * @covers \Belt\Menu\Drivers\CategoryMenuDriver::add
     */
    public function test()
    {

        $child_category = m::mock(Category::class);
        $child_category->shouldReceive('getAttribute')->with('name')->andReturn('Some Child');
        $child_category->shouldReceive('getAttribute')->with('default_url')->andReturn('/categories/some-category/some-child');

        $category = factory(Category::class)->make(['name' => 'Some Category', 'slug' => 'some-category']);
        $category->children = new Collection();
        $category->children->add($child_category);

        $menuItem = factory(MenuItem::class)->make(['label' => '', 'url' => '']);
        $adapter = new CategoryMenuDriver($menuItem, ['config' => []]);
        $adapter->category = $category;
        $menuItem->adapter = $adapter;

        # category
        $this->assertEquals($category, $adapter->category());

        # label
        $this->assertEquals('Some Category', $adapter->label());

        # url
        $this->assertEquals('/categories/some-category', $adapter->url());

        # add
        $submenuHelper = m::mock(MenuHelper::class);
        $submenuHelper->shouldReceive('add')->once()->with('/categories/some-category/some-child', 'Some Child');
        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with('/categories/some-category', 'Some Category')->andReturn($submenuHelper);
        $adapter->add($menuHelper);
    }


}