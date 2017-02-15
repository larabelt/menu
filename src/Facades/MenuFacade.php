<?php

namespace Ohio\Menu\Facades;

use Illuminate\Support\Facades\Facade;

class MenuFacade extends Facade
{
    /**
     * @see \Ohio\Menu\Menu
     */
    protected static function getFacadeAccessor(): string
    {
        return 'menu';
    }
}
