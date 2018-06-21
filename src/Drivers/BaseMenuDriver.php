<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;
use Belt\Menu\MenuItem;

/**
 * Class BaseMenuDriver
 * @package Belt\Content
 */
abstract class BaseMenuDriver
{
    use Belt\Core\Behaviors\HasConfig;

    /**
     * @var MenuItem
     */
    public $menuItem;

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    public $linkAttributes = [];

    /**
     * BaseMenuDriver constructor.
     * @param MenuItem $menuItem
     * @param array $config
     */
    public function __construct(MenuItem $menuItem, $config = [])
    {
        $this->menuItem = $menuItem;
        $this->linkAttributes['target'] = $menuItem->target ?: 'default';
        $this->setConfig($config);
    }

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     */
    abstract public function add(MenuHelper $menuHelper);

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