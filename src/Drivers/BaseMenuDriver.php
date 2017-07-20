<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;

/**
 * Class BaseMenuDriver
 * @package Belt\Content
 */
class BaseMenuDriver
{
    use Belt\Core\Behaviors\HasConfig;

    /**
     * @var MenuItem
     */
    public $menuItem;

    /**
     * BaseMenuDriver constructor.
     * @param MenuItem $menuItem
     * @param array $params
     */
    public function __construct(MenuItem $menuItem, $params = [])
    {
        $this->menuItem = $menuItem;
        $this->setConfig(array_get($params, 'config', []));
    }

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     */
    public function add(MenuHelper $menuHelper)
    {
        return $menuHelper;
    }


    /**
     * @return string
     */
    public function label()
    {
        return '';
    }

    /**
     * @return string
     */
    public function url()
    {
        return '';
    }

}