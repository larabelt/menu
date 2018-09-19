<?php

namespace Belt\Menu;

use Knp\Menu\MenuFactory as KnpMenuFactory;

/**
 * Class MenuFactory
 * @package Belt\Menu
 */
class MenuFactory extends KnpMenuFactory
{

    public function __construct()
    {
        parent::__construct();
        $this->addExtension(new MenuExtension(), -20);
    }
}