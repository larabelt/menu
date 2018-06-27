<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;

/**
 * Class PlaceMenuDriver
 * @package Belt\Content
 */
class PlaceMenuDriver extends BaseMenuDriver
{

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     * @throws \Exception
     */
    public function add(MenuHelper $menuHelper)
    {
        $place = $this->menuItem->morphParam('places');

        $submenu = $menuHelper->add(
            $place->default_url,
            $this->menuItem->label,
            $this->options,
            $this->linkAttributes
        );

        return $submenu;
    }

}