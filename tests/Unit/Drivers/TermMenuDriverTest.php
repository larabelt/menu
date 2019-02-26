<?php namespace Tests\Belt\Menu\Unit\Drivers;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Core\Param;
use Belt\Content\Term;
use Belt\Menu\Drivers\TermMenuDriver;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class TermMenuDriverTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Drivers\TermMenuDriver::term
     * @covers \Belt\Menu\Drivers\TermMenuDriver::label
     * @covers \Belt\Menu\Drivers\TermMenuDriver::url
     * @covers \Belt\Menu\Drivers\TermMenuDriver::add
     */
    public function test()
    {

        $child_term = m::mock(Term::class);
        $child_term->shouldReceive('getAttribute')->with('slug')->andReturn('some-child');
        $child_term->shouldReceive('getAttribute')->with('name')->andReturn('Some Child');
        $child_term->shouldReceive('getAttribute')->with('default_url')->andReturn('/terms/some-term/some-child');

        $term = factory(Term::class)->make(['name' => 'Some Term', 'slug' => 'some-term']);
        $term->children = new Collection();
        $term->children->add($child_term);

        $menuItem = factory(MenuItem::class)->make([
            'slug' => 'some-term-menu-item',
            'label' => '',
            'url' => ''
        ]);
        $menuItem->params = new Collection([new Param(['key' => 'show_children', 'value' => true])]);
        $adapter = new TermMenuDriver($menuItem, ['config' => []]);
        $adapter->term = $term;
        $menuItem->adapter = $adapter;

        # term
        $this->assertEquals($term, $adapter->term());

        # label
        $this->assertEquals('Some Term', $adapter->label());

        # url
        $this->assertEquals('/terms/some-term', $adapter->url());

        # add
        $submenuHelper = m::mock(MenuHelper::class);
        $submenuHelper->shouldReceive('add')->once()->with(
            '/terms/some-term/some-child',
            'Some Child',
            ['name' => 'some-child'],
            [],
            $menuItem
        );
        $menuHelper = m::mock(MenuHelper::class);
        $menuHelper->shouldReceive('add')->once()->with(
            '/terms/some-term',
            'Some Term',
            ['name' => 'some-term-menu-item'],
            ['target' => 'default'],
            $menuItem
        )->andReturn($submenuHelper);
        $adapter->add($menuHelper);
    }


}