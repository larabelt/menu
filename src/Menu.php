<?php

namespace Belt\Menu;

use Illuminate\Support\Traits\Macroable;
use Knp\Menu\MenuFactory;

class Menu
{

    use Macroable;

    public static $menus = [];

    public function get($key, $parameters = [])
    {

        $keys = explode('.', $key);

        if (isset(static::$menus[$keys[0]])) {
            $menu = static::$menus[$keys[0]];
        } else {
            $menu = $this->__call($keys[0], $parameters);
            static::$menus[$keys[0]] = $menu;
        }

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