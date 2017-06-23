<?php

namespace Belt\Menu;

use Belt;
use Belt\Core\Helpers\StrHelper;
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
    Belt\Core\Behaviors\SluggableInterface
{

    use NodeTrait {
        children as nodeChildren;
    }
    use Belt\Core\Behaviors\Paramable;
    use Belt\Core\Behaviors\Sluggable;

    /**
     * @var string
     */
    protected $morphClass = 'menu_items';

    /**
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * @param $value
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = StrHelper::normalizeUrl($value);
    }

//    /**
//     * @return array
//     */
//    public function toArray()
//    {
//        $data = parent::toArray();
//        $data['ancestors'] = $this->getAncestors()->pluck('label')->all();
//
//        return $data;
//    }

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

}