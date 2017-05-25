<?php

namespace Belt\Menu;

use Belt\Menu\Services\MenuService;
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

            (new MenuService())->push($key);

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
    public static function create($name)
    {
        $menu = (new MenuFactory())->createItem($name);

        return new MenuHelper($menu);
    }

    /**
     * @param MenuHelper $menu
     * @param MenuItem $parent
     */
    public static function submenu(MenuHelper $menu, MenuItem $parent)
    {
        if ($children = $parent->children) {
            $menu->add(function ($menu) use ($children) {
                foreach ($children as $child) {
                    $submenu = $menu->add($child->url, $child->label);
                    static::submenu($submenu, $child);
                }
            });
        }

    }

}