<?php

namespace Belt\Menu;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MenuGroup
 * @package Belt\Menu
 */
class MenuGroup extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\IncludesContentInterface
{
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\IncludesContent;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $morphClass = 'menu_groups';

    /**
     * @var string
     */
    protected $table = 'menu_groups';

    /**
     * @var array
     */
    protected $fillable = ['name', 'body'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('_lft');
    }

}