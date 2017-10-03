<?php

namespace Belt\Menu;

use ArrayIterator, Cache, Knp, RecursiveIteratorIterator;
use Belt\Content\Behaviors\HandleableInterface;
use Illuminate\Http\Request;
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
     * @param array $linkAttributes
     * @return MenuHelper|mixed
     */
    public function add($uri, $label = null, $options = [], $linkAttributes = [])
    {

        if ($uri instanceof \Closure) {
            return call_user_func($uri, $this);
        }

        $prefix = $this->menu->getUri() ?: '';

        // apply prefix if uri is relative
        if ($prefix && substr($uri, 0, 1) != '/' && substr($uri, 0, 4) != 'http') {
            $uri = $prefix ? "$prefix/$uri" : $uri;
        }

        $options = array_merge($options, ['uri' => $uri, 'label' => $label]);

        $name = array_get($options, 'name', str_slug($label));

        $menuItem = $this->menu->addChild($name, $options);

        foreach ($linkAttributes as $key => $value) {
            $menuItem->setLinkAttribute($key, $value);
        }

        return new MenuHelper($menuItem);
    }

    /**
     * @param $uri
     * @return ItemInterface|mixed|null
     */
    public function active($uri)
    {
        $this->active = null;

        //dump(111);
        //dump($uri);

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
            $this->setActive($item);
            break;
        }

        return $this->active;
    }

    /**
     * @param null $section
     */
    public function guessActive($section = null)
    {
        if ($this->active) {
            return;
        }

        $this->setActiveByOwner($section);

        if (!$this->active) {
            $request = Request::capture();
            $path = $request->path();
            $this->active("/$path");
        }

    }

    /**
     * @param $section
     */
    public function setActiveByOwner($section)
    {
        if ($section && $owner = $section->owner) {
            if ($owner instanceof HandleableInterface && $handle = $owner->handle) {
                $this->active($handle->url);
            }
        }
    }

    /**
     * @param $item
     */
    public function setActive($item)
    {
        $item->setCurrent(true);
        if ($parent = $item->getParent()) {
            $this->setActive($parent);
        }
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