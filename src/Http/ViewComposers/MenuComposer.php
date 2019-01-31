<?php

namespace Belt\Menu\Http\ViewComposers;

use Belt, Menu;
use Illuminate\Contracts\View\View;

class MenuComposer
{

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @throws \Exception
     */
    public function compose(View $view)
    {
        $data = $view->getData();

        $menu = array_get($data, 'menu', 'main');
        $active = array_get($data, 'active');
        $classes = array_get($data, 'classes', '');

        try {
            $menu = is_string($menu) ? Menu::get($menu) : $menu;
        } catch (\Exception $e) {
            $menu = Menu::create('empty');
        }

        if (!$menu instanceof Belt\Menu\MenuHelper) {
            throw new \Exception('invalid menu object or key');
        }

        if ($active) {
            $menu->active($active);
        } else {
            $menu->guessActive();
        }

        $view->with('menu', $menu);
        $view->with('name', $menu->menu()->getName());
        $view->with('classes', $classes);
    }

}