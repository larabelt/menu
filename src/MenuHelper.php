<?php

namespace Ohio\Menu;

use Knp;
use ArrayIterator;
use RecursiveIteratorIterator;
use Knp\Menu\Iterator\CurrentItemFilterIterator;
use Knp\Menu\Iterator\RecursiveItemIterator;
use Knp\Menu\MenuItem;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\UriVoter;
use Knp\Menu\Matcher\Voter\RegexVoter;
use Knp\Menu\Renderer\ListRenderer;
use Knp\Menu\Util\MenuManipulator;

class MenuHelper
{

    /**
     * @var MenuItem
     */
    public $menu;

    public function __construct(MenuItem $menu)
    {
        $this->menu = $menu;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function menu()
    {
        return $this->menu;
    }

    public function submenu($key)
    {
        $menu = array_get($this->menu, $key, $this->menu);

        return new MenuHelper($menu);
    }

    public function items()
    {
        return $this->menu->getChildren();
    }

    public function current($uri)
    {
        $menu = clone $this->menu;

        $matcher = new Matcher();
        $matcher->addVoter(new UriVoter($uri));

        $treeIterator = new RecursiveIteratorIterator(
            new RecursiveItemIterator(new ArrayIterator([$menu])),
            RecursiveIteratorIterator::SELF_FIRST
        );

        $iterator = new CurrentItemFilterIterator($treeIterator, $matcher);

        foreach ($iterator as $item) {
            return $item;
        }

        return null;
    }

    public function breadcrumbs($item)
    {
        $menu = clone $this->menu;

        $item = is_string($item) ? $this->current($item) : $item;

        $manipulator = new MenuManipulator();

        $crumbs = $manipulator->getBreadcrumbsArray($menu, $item);

        return $crumbs;
    }

    public function render($options = [])
    {
        $menu = clone $this->menu;

        $matcher = new Matcher();

        if ($active = array_get($options, 'active')) {
            $matcher->addVoter(new UriVoter($active));
        }

        $result = (new ListRenderer($matcher))->render($menu);

        return $result;
    }


}