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
     * @throws \Exception
     */
    public function add(MenuHelper $menuHelper)
    {
        $submenu = $menuHelper->add(
            $this->menuItem->url,
            $this->menuItem->label,
            $this->options,
            $this->linkAttributes,
            $this->menuItem
        );

        return $submenu;
    }

}