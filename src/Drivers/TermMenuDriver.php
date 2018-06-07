<?php

namespace Belt\Menu\Drivers;

use Belt;
use Belt\Menu\MenuHelper;
use Belt\Content\Term;

/**
 * Class TermMenuDriver
 * @package Belt\Content
 */
class TermMenuDriver extends BaseMenuDriver
{

    /**
     * @var Term
     */
    public $term;

    /**
     * @return mixed
     */
    public function term()
    {
        return $this->term ?: $this->term = $this->menuItem->morphParam('terms');
    }

    /**
     * @param MenuHelper $menuHelper
     * @return MenuHelper|mixed
     */
    public function add(MenuHelper $menuHelper)
    {
        $term = $this->term();

        $submenu = $menuHelper->add($this->menuItem->url, $this->menuItem->label, $this->options, $this->linkAttributes);

        if ($this->menuItem->param('show_children', true)) {
            foreach ($term->children as $child) {
                $submenu->add($child->default_url, $child->name);
            }
        }

        return $submenu;
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->term()->name;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->term()->default_url;
    }
}