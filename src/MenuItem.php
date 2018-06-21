<?php

namespace Belt\Menu;

use Belt;
use Belt\Core\Helpers\UrlHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Section
 * @package Belt\Content
 */
class MenuItem extends Model implements
    Belt\Core\Behaviors\NestedSetInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface
{

    use NodeTrait {
        children as nodeChildren;
    }
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\IncludesTemplate;

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
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
        //$this->attributes['url'] = $value ? UrlHelper::normalize($value) : null;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getLabelAttribute($value)
    {
        return $value ?: $this->adapter()->label();
    }

    /**
     * @param $value
     * @return mixed
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
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function menuable()
    {
        return $this->morphTo();
    }

    /**
     * Get adapter instance
     *
     * @return mixed
     * @throws \Exception
     */
    public function adapter()
    {
        return $this->adapter ?: $this->adapter = $this->initAdapter();
    }

    /**
     * Instantiate adapter instance
     *
     * @return mixed
     * @throws \Exception
     */
    public function initAdapter()
    {
        $driver = $this->getTemplateConfig('driver', Belt\Menu\Drivers\DefaultMenuDriver::class);

        return new $driver($this, ['config' => $this->getTemplateConfig()]);
    }

}