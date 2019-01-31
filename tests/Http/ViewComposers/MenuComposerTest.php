<?php

use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Menu\MenuHelper;
use Belt\Menu\Http\ViewComposers\MenuComposer;
use Belt\Menu\Facades\MenuFacade as Menu;
use Illuminate\Contracts\View\View;
use Knp\Menu\ItemInterface;

class MenuComposerTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Menu\Http\ViewComposers\MenuComposer::compose
     */
    public function test1()
    {
        $composer = new MenuComposer();

        // menu
        $knpMenuObject = m::mock(ItemInterface::class);
        $knpMenuObject->shouldReceive('getName')->once()->andReturn('FOO');
        $menu = m::mock(MenuHelper::class);
        $menu->shouldReceive('active')->once()->with('/pages/1');
        $menu->shouldReceive('menu')->once()->andReturn($knpMenuObject);

        // view
        $view = m::mock(View::class);
        $view->shouldReceive('getData')->once()->andReturn([
            'menu' => 'foo',
            'active' => '/pages/1',
            'classes' => 'special',
        ]);
        $view->shouldReceive('with')->once()->with('menu', $menu);
        $view->shouldReceive('with')->once()->with('name', 'FOO');
        $view->shouldReceive('with')->once()->with('classes', 'special');

        Menu::shouldReceive('get')->once()->with('foo')->andReturn($menu);

        $composer->compose($view);
    }

    /**
     * @covers \Belt\Menu\Http\ViewComposers\MenuComposer::compose
     */
    public function test2()
    {
        $composer = new MenuComposer();

        // menu
        $knpMenuObject = m::mock(ItemInterface::class);
        $knpMenuObject->shouldReceive('getName')->once()->andReturn('FOO');
        $menu = m::mock(MenuHelper::class);
        $menu->shouldReceive('guessActive')->once();
        $menu->shouldReceive('menu')->once()->andReturn($knpMenuObject);

        // view
        $view = m::mock(View::class);
        $view->shouldReceive('getData')->once()->andReturn([
            'menu' => 'foo',
        ]);
        $view->shouldReceive('with')->once()->with('menu', $menu);
        $view->shouldReceive('with')->once()->with('name', 'FOO');
        $view->shouldReceive('with')->once()->with('classes', '');

        Menu::shouldReceive('get')->once()->with('foo')->andReturn($menu);

        $composer->compose($view);
    }

    /**
     * @covers \Belt\Menu\Http\ViewComposers\MenuComposer::compose
     */
    public function test3()
    {
        $composer = new MenuComposer();

        // menu
        $knpMenuObject = m::mock(ItemInterface::class);
        $knpMenuObject->shouldReceive('getName')->once()->andReturn('FOO');
        $menu = m::mock(MenuHelper::class);
        $menu->shouldReceive('guessActive')->once();
        $menu->shouldReceive('menu')->once()->andReturn($knpMenuObject);

        // view
        $view = m::mock(View::class);
        $view->shouldReceive('getData')->once()->andReturn([
            'menu' => 'foo',
        ]);
        $view->shouldReceive('with')->once()->with('menu', $menu);
        $view->shouldReceive('with')->once()->with('name', 'FOO');
        $view->shouldReceive('with')->once()->with('classes', '');

        Menu::shouldReceive('get')->once()->with('foo')->andThrow(Exception::class);
        Menu::shouldReceive('create')->once()->with('empty')->andReturn($menu);

        $composer->compose($view);
    }

    /**
     * @covers \Belt\Menu\Http\ViewComposers\MenuComposer::compose
     */
    public function test4()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('invalid menu object or key');

        $composer = new MenuComposer();

        // view
        $view = m::mock(View::class);
        $view->shouldReceive('getData')->once()->andReturn([
            'menu' => 'foo',
            'active' => '/pages/1',
            'classes' => 'special',
        ]);

        Menu::shouldReceive('get')->andReturn('invalid response');

        $composer->compose($view);
    }
}