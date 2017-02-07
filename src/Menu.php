<?php

namespace Ohio\Menu;

use Spatie\Menu\Laravel\Menu as LaravelMenu;
use Spatie\Menu\Laravel\Link as LaravelLink;
use Spatie\Menu\Menu as SpatieMenu;
use Spatie\Menu\Link as SpatieLink;

class Menu extends LaravelMenu
{

    public function items()
    {
        return $this->items;
    }

    public function breadcrumbs()
    {
        $crumbs = [];
        foreach ($this->items as $item) {
            $crumbs = $this->__breadcrumbs($item, $crumbs);
        }

        return $crumbs;
    }

    public function __breadcrumbs($item, $crumbs = [])
    {
        if ($item->isActive()) {
            if ($item instanceof SpatieLink) {
                $crumbs[] = $item->render();
            }
            if ($item instanceof SpatieMenu) {
                if ($item->prepend) {
                    $crumbs[] = $item->prepend;
                }
                foreach ($item->items as $subItem) {
                    $crumbs = $this->__breadcrumbs($subItem, $crumbs);
                }
            }
        }

        return $crumbs;
    }

    public function setActiveFromRequest(string $requestRoot = '/')
    {
        $url = sprintf('/%s', app('request')->path());

        return $this->setActive($url, $requestRoot);
    }

}