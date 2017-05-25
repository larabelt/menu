<?php

namespace Belt\Menu\Services;

use Belt, Menu;
use Belt\Menu\MenuGroup;
use Belt\Menu\MenuItem;
use Belt\Menu\MenuHelper;
use Knp\Menu\ItemInterface;

/**
 * Class MenuService
 * @package Belt\Content\Services
 */
class MenuService
{

    /**
     * Add db-driven macro if applicable
     *
     * @param $key
     * @return bool
     */
    public function push($key)
    {
        if (Menu::hasMacro($key)) {
            return;
        }

        $menuGroup = MenuGroup::sluggish($key)->first();

        if ($menuGroup) {
            $this->load($menuGroup);
        }
    }

    /**
     * @param MenuGroup $menuGroup
     */
    public function load(MenuGroup $menuGroup)
    {
        Menu::macro($menuGroup->slug, function () use ($menuGroup) {

            $menu = Menu::create($menuGroup->slug);

            foreach ($menuGroup->menuItems as $menuItem) {
                $submenu = $menu->add($menuItem->url, $menuItem->label);
                Menu::submenu($submenu, $menuItem);
            }

            return $menu;
        });
    }

    /**
     * Convert hard-coded menu into db-driven menu
     *
     * @param $name
     */
    public function build($name)
    {
        if (MenuGroup::sluggish($name)->first()) {
            return;
        }

        /**
         * @var $menu MenuHelper
         */
        $menu = Menu::get($name);

        if (!$menu) {
            return;
        }

        MenuGroup::unguard();
        MenuItem::unguard();

        $menuGroup = MenuGroup::create([
            'name' => $name,
            'slug' => $name,
        ]);

        /**
         * @var $item ItemInterface
         */
        foreach ($menu->items() as $item) {
            $this->__build($menuGroup, $item);
        }
    }

    /**
     * @param MenuGroup $menuGroup
     * @param ItemInterface $item
     * @param MenuItem|null $parent
     */
    public function __build(MenuGroup $menuGroup, ItemInterface $item, MenuItem $parent = null)
    {
        $menuItem = MenuItem::create([
            'parent_id' => $parent ? $parent->id : null,
            'menu_group_id' => $menuGroup->id,
            'label' => $item->getLabel(),
            'url' => $item->getUri(),
            'slug' => $item->getName(),
        ]);

        foreach ($item->getChildren() as $child) {
            $this->__build($menuGroup, $child, $menuItem);
        }
    }

}