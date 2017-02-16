<?php

namespace Belt\Menu\Facades;

use Illuminate\Support\Facades\Facade;

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
