<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;

/**
 * Class DefaultMenuDriver
 * @package Belt\Content
 */
class DefaultMenuDriver extends BaseMenuDriver
{

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     */
    public function add(MenuHelper $menuHelper)
    {
        $submenu = $menuHelper->add($this->menuItem->url, $this->menuItem->label);

        return $submenu;
    }

}