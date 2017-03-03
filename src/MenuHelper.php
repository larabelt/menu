<?php

namespace Belt\Menu;

use Knp;
use ArrayIterator;
use RecursiveIteratorIterator;
use Knp\Menu\Iterator\CurrentItemFilterIterator;
use Knp\Menu\Iterator\RecursiveItemIterator;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\UriVoter;
use Knp\Menu\Renderer\ListRenderer;
use Knp\Menu\Util\MenuManipulator;
use Knp\Menu\ItemInterface;

/**
 * Class MenuHelper
 * @package Belt\Menu
 */
class MenuHelper
{

    /**
     * @var ItemInterface
     */
    public $menu;

    /**
     * @var ItemInterface
     */
    public $active;

    /**
     * MenuHelper constructor.
     * @param $menu
     */
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return ItemInterface
     */
    public function menu()
    {
        return $this->menu;
    }

    /**
     * @param $key
     * @return MenuHelper
     */
    public function submenu($key)
    {
        $menu = array_get($this->menu, $key, $this->menu);

        return new MenuHelper($menu);
    }

    /**
     * @return ItemInterface[]
     */
    public function items()
    {
        return $this->menu->getChildren();
    }

    /**
     * @param $uri
     * @param null $label
     * @param array $options
     * @return MenuHelper|mixed
     */
    public function add($uri, $label = null, $options = [])
    {

        if ($uri instanceof \Closure) {
            return call_user_func($uri, $this);
        }

        $options = array_merge($options, ['uri' => $uri, 'label' => $label]);

        $name = array_get($options, 'name', str_slug($label));

        $menuItem = $this->menu->addChild($name, $options);

        return new MenuHelper($menuItem);
    }

    /**
     * @param $uri
     * @return ItemInterface|mixed|null
     */
    public function active($uri)
    {
        $this->active = null;

        $menu = clone $this->menu;

        $matcher = new Matcher();
        $matcher->addVoter(new UriVoter($uri));

        $treeIterator = new RecursiveIteratorIterator(
            new RecursiveItemIterator(new ArrayIterator([$menu])),
            RecursiveIteratorIterator::SELF_FIRST
        );

        $iterator = new CurrentItemFilterIterator($treeIterator, $matcher);

        foreach ($iterator as $item) {
            $this->active = $item;
            $item->setCurrent(true);
            break;
        }

        return $this->active;
    }

    /**
     * @return array
     */
    public function breadcrumbs()
    {
        $menu = clone $this->menu;

        $results = (new MenuManipulator())->getBreadcrumbsArray($menu, $this->active);

        $crumbs = [];
        foreach ($results as $result) {
            if ($uri = array_get($result, 'uri')) {
                $crumbs[] = (object) [
                    'label' => array_get($result, 'label'),
                    'uri' => $uri,
                ];
            }
        }

        return $crumbs;
    }

    /**
     * @return string
     */
    public function render()
    {
        $menu = clone $this->menu;

        $matcher = new Matcher();

        if ($this->active) {
            $matcher->addVoter(new UriVoter($this->active->getUri()));
        }

        $result = (new ListRenderer($matcher, ['currentClass' => 'active']))->render($menu);

        return $result;
    }


}