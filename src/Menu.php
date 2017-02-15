<?php

namespace Ohio\Menu;

use Illuminate\Support\Traits\Macroable;
use Knp\Menu\MenuFactory;

class Menu
{

    use Macroable;

    public function get($key, $parameters = [])
    {

        $keys = explode('.', $key);

        $menu = $this->__call($keys[0], $parameters);

        if (count($keys) > 1) {
            $menu = $menu->submenu(implode('.', array_slice($keys, 1)));
        }

        return $menu;
    }

    public function create($name)
    {
        $menu = (new MenuFactory())->createItem($name);

        return new MenuHelper($menu);
    }

}