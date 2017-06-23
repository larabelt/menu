<?php

namespace Belt\Menu\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateMenuItems extends PaginateRequest
{
    public $perPage = 100;

    public $orderBy = 'menu_items._lft';

    public $sortable = [
        'menu_items.id',
        'menu_items.name',
        'menu_items._lft',
    ];

    public $searchable = [
        'menu_items.name',
    ];

    public function modifyQuery(Builder $query)
    {
        if ($menuGroupId = $this->get('menu_group_id')) {
            $query->where('menu_group_id', $menuGroupId);
        }

        $query->withDepth();

        return $query;
    }

}