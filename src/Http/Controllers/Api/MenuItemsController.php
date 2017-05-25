<?php

namespace Belt\Menu\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Helpers\MorphHelper;
use Belt\Menu\Http\Requests;
use Belt\Menu\MenuGroup;
use Belt\Menu\MenuItem;
use Illuminate\Http\Request;

class MenuItemsController extends ApiController
{

    /**
     * @var MenuItem
     */
    public $menuItems;

    /**
     * @var MorphHelper
     */
    public $morphHelper;

    /**
     * @var CompileService
     */
    public $service;

    public function __construct(MenuItem $menuItem, MorphHelper $morphHelper)
    {
        $this->menuItems = $menuItem;
        $this->morphHelper = $morphHelper;
    }

    public function section($id, $owner = null)
    {
        $qb = $this->sections->query();

        if ($owner) {
            $qb->owned($owner->getMorphClass(), $owner->id);
        }

        $section = $qb->where('sections.id', $id)->first();

        return $section ?: $this->abort(404);
    }

    public function contains(MenuGroup $menuGroup, MenuItem $menuItem)
    {
        if ($menuItem->menu_group_id != $menuGroup->id) {
            $this->abort(404);
        }
    }

    /**
     * @return CompileService
     */
    public function service()
    {
        return $this->service = $this->service ?: new CompileService();
    }

    /**
     * Cache sections
     *
     * @param $owner
     */
    public function cache($owner)
    {
        if ($owner instanceof HasSectionsInterface) {
            $this->service()->cache($owner, true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param MenuGroup $menuGroup
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MenuGroup $menuGroup)
    {

        $request = Requests\PaginateMenuItems::extend($request);

        $this->authorize('view', $menuGroup);

        $request->merge(['menu_group_id' => $menuGroup->id]);

        $paginator = $this->paginator($this->menuItems->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param Requests\StoreMenuItem $request
     * @param MenuGroup $menuGroup
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreMenuItem $request, MenuGroup $menuGroup)
    {
        $this->authorize('update', $menuGroup);

        $input = $request->all();

        MenuItem::unguard();

        $menuItem = $this->menuItems->create([
            'menu_group_id' => $menuGroup->id,
        ]);

        $this->set($menuItem, $input, [
            'parent_id',
            'menuable_id',
            'menuable_type',
            'label',
            'url',
            'target',
            'slug',
        ]);

        $menuItem->save();

        //$this->cache($owner);

        return response()->json($menuItem, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param MenuGroup $menuGroup
     * @param MenuItem $menuItem
     *
     * @return \Illuminate\Http\Response
     */
    public function show(MenuGroup $menuGroup, MenuItem $menuItem)
    {
        $this->contains($menuGroup, $menuItem);

        $this->authorize('view', $menuGroup);

        return response()->json($menuItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UpdateMenuItem $request
     * @param MenuGroup $menuGroup
     * @param MenuItem $menuItem
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateMenuItem $request, MenuGroup $menuGroup, MenuItem $menuItem)
    {

        $this->contains($menuGroup, $menuItem);

        $this->authorize('update', $menuGroup);

        $input = $request->all();

        $this->set($menuItem, $input, [
            'parent_id',
            'menuable_id',
            'menuable_type',
            'label',
            'url',
            'target',
            'slug',
        ]);

        $menuItem->save();

        //$this->cache($owner);

        return response()->json($menuItem);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param MenuGroup $menuGroup
     * @param MenuItem $menuItem
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuGroup $menuGroup, MenuItem $menuItem)
    {
        $this->contains($menuGroup, $menuItem);

        $this->authorize('update', $menuGroup);

        $menuItem->delete();

        //$this->cache($owner);

        return response()->json(null, 204);
    }
}
