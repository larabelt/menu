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

            $menuHelper = $this->create($menuGroup->slug);

            foreach ($menuGroup->menuItems as $menuItem) {
                $this->add($menuHelper, $menuItem);
            }

            return $menuHelper;
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
     * Add item to menu
     *
     * @param MenuHelper $menuHelper
     * @param MenuItem $menuItem
     */
    public function add(MenuHelper $menuHelper, MenuItem $menuItem)
    {
        //$submenu = $menu->add($menuItem->url, $menuItem->label);
        $submenuHelper = $menuItem->adapter()->add($menuHelper);

        if ($children = $menuItem->children) {
            $submenuHelper->add(function ($submenuHelper) use ($children) {
                foreach ($children as $child) {
                    $this->add($submenuHelper, $child);
                }
            });
        }
    }

}