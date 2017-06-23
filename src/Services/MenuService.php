<?php

namespace Belt\Menu\Services;

use Belt;
use Belt\Menu\Menu;
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
     * @var MenuGroup
     */
    public $menuGroup;

    /**
     * @var MenuItem
     */
    public $menuItem;

    public function __construct()
    {
        $this->menu = new Menu();
        $this->menuGroup = new MenuGroup();
        $this->menuItem = new MenuItem();
    }

    /**
     * Convert hard-coded menu into db-driven menu
     *
     * @param $name
     */
    public function build($name)
    {
        # skip if it already exists in db
        if ($this->menuGroup->sluggish($name)->first()) {
            return;
        }

        /**
         * @var $menu MenuHelper
         */
        $menu = $this->menu->get($name);

        # skip if isn't loaded as a macro via hard-coding
        if (!$menu) {
            return;
        }

        MenuGroup::unguard();
        MenuItem::unguard();

        $menuGroup = $this->menuGroup->create([
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
        $menuItem = $this->menuItem->create([
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