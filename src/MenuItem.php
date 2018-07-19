<?php

namespace Belt\Menu;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Section
 * @package Belt\Content
 */
class MenuItem extends Model implements
    Belt\Core\Behaviors\NestedSetInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Core\Behaviors\IncludesSubtypesInterface
{

    use NodeTrait {
        children as nodeChildren;
    }
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\IncludesSubtypes;

    /**
     * @var string
     */
    protected $morphClass = 'menu_items';

    /**
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * @var mixed
     */
    public $adapter;

    /**
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function getLabelAttribute()
    {
        return $this->adapter()->label();
    }

    /**
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function getUrlAttribute($value)
    {
        return $value ?: $this->adapter()->url();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuGroup()
    {
        return $this->belongsTo(MenuGroup::class);
    }

    /**
     * Child sections
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->nodeChildren()->orderBy('_lft');
    }

    /**
     * Get adapter instance
     *
     * @return mixed
     * @throws \Exception
     */
    public function adapter()
    {
        return $this->adapter ?: $this->initAdapter();
    }

    /**
     * Instantiate adapter instance
     *
     * @return mixed
     * @throws \Exception
     */
    public function initAdapter()
    {
        $driver = $this->getSubtypeConfig('driver', Belt\Menu\Drivers\DefaultMenuDriver::class);

        $adapter = new $driver($this, ['config' => $this->getSubtypeConfig()]);

        return $this->adapter = $adapter;
    }

}