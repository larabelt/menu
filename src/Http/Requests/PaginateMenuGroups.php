<?php
namespace Belt\Menu\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;

class PaginateMenuGroups extends PaginateRequest
{
    public $perBlock = 10;

    public $orderBy = 'menu_groups.name';

    public $sortable = [
        'menu_groups.id',
        'menu_groups.name',
    ];

    public $searchable = [
        'menu_groups.name',
    ];

}