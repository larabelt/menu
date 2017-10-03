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
     * @var array
     */
    public static $submenus = [];

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

        if (str_contains($key, '.')) {
            $menu = $this->getSubmenu($key, $parameters = []);
        } else {
            $menu = $this->getMenu($key, $parameters = []);
        }

        $menu->guessActive();

        return $menu;
    }

    /**
     * @param $key
     * @param array $parameters
     * @return mixed|null
     * @throws \Exception
     */
    public function getMenu($key, $parameters = [])
    {
        $menu = static::$menus[$key] ?? null;

        # search hard-code macro
        if (!$menu && $this->hasMacro($key)) {
            $menu = $this->__call($key, $parameters);
        }

        # search db and create macro
        if (!$menu && $menuGroup = $this->menuGroup->sluggish($key)->first()) {
            $this->load($menuGroup);
            $menu = $this->__call($key, $parameters);
        }

        # statically save menu & return
        if ($menu) {
            static::$menus[$key] = static::$menus[$key] ?? $menu;
            return $menu;
        }

        throw new \Exception("menu '$key' not defined");
    }

    /**
     * @param $key
     * @param array $parameters
     * @return mixed|null
     * @throws \Exception
     */
    public function getSubMenu($key, $parameters = [])
    {

        $keys = explode('.', $key);
        $slug = $keys[0];

        $submenu = static::$submenus[$key] ?? null;

        if (!$submenu) {
            $menu = $this->getMenu($slug, $parameters);
            $submenu = $menu->submenu(implode('.', array_slice($keys, 1)));
            static::$submenus[$key] = static::$submenus[$key] ?? $submenu;
        }

        if ($submenu) {
            return $submenu;
        }

        throw new \Exception("submenu '$key' not defined");
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