<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;

/**
 * Class PageMenuDriver
 * @package Belt\Content
 */
class PageMenuDriver extends BaseMenuDriver
{

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     * @throws \Exception
     */
    public function add(MenuHelper $menuHelper)
    {
        $page = $this->menuItem->morphParam('pages');

        $submenu = $menuHelper->add(
            $page->default_url,
            $this->menuItem->label,
            $this->options,
            $this->linkAttributes
        );

        return $submenu;
    }

}