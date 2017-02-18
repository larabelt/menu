<?php

namespace Belt\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MenuFacade
 * @package Belt\Menu\Facades
 */
class MenuFacade extends Facade
{
    /**
     * @see \Belt\Menu\Menu
     */
    protected static function getFacadeAccessor(): string
    {
        return 'menu';
    }
}
