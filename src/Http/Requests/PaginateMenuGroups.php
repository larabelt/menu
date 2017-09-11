<?php
namespace Belt\Menu\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;

class PaginateMenuGroups extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Menu\MenuGroup::class;

    public $perBlock = 10;

    public $orderBy = 'menu_groups.name';

    public $sortable = [
        'menu_groups.id',
        'menu_groups.name',
    ];

    public $searchable = [
        'menu_groups.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
    ];

}