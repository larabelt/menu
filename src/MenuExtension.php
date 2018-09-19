<?php

namespace Belt\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Factory\ExtensionInterface;

/**
 * Class MenuExtension
 * @package Belt\Menu
 */
class MenuExtension implements ExtensionInterface
{
    /**
     * Builds the full option array used to configure the item.
     *
     * @param array $options
     *
     * @return array
     */
    public function buildOptions(array $options)
    {
        return array_merge(
            [],
            $options
        );
    }

    /**
     * Configures the newly created item with the passed options
     *
     * @param ItemInterface $item
     * @param array $options
     */
    public function buildItem(ItemInterface $item, array $options)
    {

    }
}