<?php

namespace Belt\Menu;

use Illuminate\Support\Traits\Macroable;
use Knp\Menu\MenuFactory;

/**
 * Class Menu
 * @package Belt\Menu
 */
class Menu
{

    use Macroable;

    /**
     * @var array
     */
    public static $menus = [];

    /**
     * @param $key
     * @param array $parameters
     * @return mixed
     */
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

    /**
     * @param $name
     * @return MenuHelper
     */
    public function create($name)
    {
        $menu = (new MenuFactory())->createItem($name);

        return new MenuHelper($menu);
    }

}