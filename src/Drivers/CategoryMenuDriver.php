<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;
use Belt\Glue\Category;

/**
 * Class CategoryMenuDriver
 * @package Belt\Content
 */
class CategoryMenuDriver extends BaseMenuDriver
{

    /**
     * @var Category
     */
    public $category;

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->category ?: $this->category = $this->menuItem->morphParam('categories');
    }

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     */
    public function add(MenuHelper $menuHelper)
    {
        $category = $this->category();

        $submenu = $menuHelper->add($this->menuItem->url, $this->menuItem->label);

        if ($this->menuItem->param('show_children', true)) {
            foreach ($category->children as $child) {
                $submenu->add($child->default_url, $child->name);
            }
        }

        return $submenu;
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->category()->name;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->category()->default_url;
    }
}