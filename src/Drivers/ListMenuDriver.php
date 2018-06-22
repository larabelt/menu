<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;

/**
 * Class ListMenuDriver
 * @package Belt\Content
 */
class ListMenuDriver extends BaseMenuDriver
{

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     * @throws \Exception
     */
    public function add(MenuHelper $menuHelper)
    {
        $list = $this->menuItem->morphParam('lists');

        $submenu = $menuHelper->add($list->default_url, $this->menuItem->label, $this->options, $this->linkAttributes);

        return $submenu;
    }

}