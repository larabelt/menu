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
     * @var MenuGroup
     */
    public $menuGroup;

    public function __construct()
    {
        $this->menuGroup = new MenuGroup();
    }

    /**
     * @param $key
     * @param array $parameters
     * @return mixed|null
     * @throws \Exception
     */
    public function get($key, $parameters = [])
    {
        $keys = explode('.', $key);

        $slug = $keys[0];

        $menu = static::$menus[$slug] ?? null;

        # search hard-code macro
        if (!$menu && $this->hasMacro($slug)) {
            $menu = $this->__call($slug, $parameters);
        }

        # search db and create macro
        if (!$menu && $menuGroup = $this->menuGroup->sluggish($slug)->first()) {
            $this->load($menuGroup);
            $menu = $this->__call($slug, $parameters);
        }

        # statically save menu & return
        if ($menu) {
            static::$menus[$slug] = $menu;
            # return submenu instead
            if (count($keys) > 1) {
                $menu = $menu->submenu(implode('.', array_slice($keys, 1)));
            }
            return $menu;
        }

        throw new \Exception("menu '$slug' not defined");
    }

    /**
     * @param MenuGroup $menuGroup
     */
    public function load(MenuGroup $menuGroup)
    {
        $this->macro($menuGroup->slug, function () use ($menuGroup) {

            $menu = $this->create($menuGroup->slug);

            foreach ($menuGroup->menuItems as $menuItem) {
                $submenu = $menu->add($menuItem->url, $menuItem->label);
                $this->submenu($submenu, $menuItem);
            }

            return $menu;
        });
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

    /**
     * @param MenuHelper $menu
     * @param MenuItem $parent
     */
    public function submenu(MenuHelper $menu, MenuItem $parent)
    {
        if ($children = $parent->children) {
            $menu->add(function ($menu) use ($children) {
                foreach ($children as $child) {
                    $submenu = $menu->add($child->url, $child->label);
                    $this->submenu($submenu, $child);
                }
            });
        }
    }

}