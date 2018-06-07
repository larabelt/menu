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

        $options = [];

        $submenu = $menuHelper->add($this->menuItem->url, $this->menuItem->label, $this->options, $this->linkAttributes);

        return $submenu;
    }

}