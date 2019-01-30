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
        // get / reset menu
        $menu = array_get($view->getData(), 'menu', 'main');
        $menu = is_string($menu) ? Menu::get($menu) : $menu;
        if (!$menu instanceof Belt\Menu\MenuHelper) {
            throw new \Exception('invalid menu object or key');
        }
        if (isset($active)) {
            $menu->active($active);
        } else {
            $menu->guessActive();
        }

        $view->with('menu', $menu);
        $view->with('name', $menu->menu()->getName());
        $view->with('classes', array_get($view->getData(), 'classes', ''));
    }

}