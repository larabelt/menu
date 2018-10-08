<?php

namespace Belt\Menu\Resources\Subtypes;

use Belt;

/**
 * Class BaseParam
 * @package Belt\Core\Resources\Params
 * @property array $display (Options include: url, slug, target)
 */
class BaseMenuItem extends Belt\Core\Resources\BaseSubtype
{
    use Belt\Core\Resources\Traits\HasDisplay,
        Belt\Core\Resources\Traits\HasDriver;

    /**
     * @return mixed
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['display'] = $this->getDisplay();
        $array['driver'] = $this->getDriver();

        return $array;
    }
}