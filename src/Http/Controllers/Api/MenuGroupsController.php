<?php

namespace Belt\Menu\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Menu\MenuGroup;
use Belt\Menu\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class MenuGroupsController
 * @package Belt\Content\Http\Controllers\Api
 */
class MenuGroupsController extends ApiController
{

    /**
     * @var MenuGroup
     */
    public $menuGroup;

    /**
     * ApiController constructor.
     * @param MenuGroup $menuGroup
     */
    public function __construct(MenuGroup $menuGroup)
    {
        $this->menuGroups = $menuGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], MenuGroup::class);

        $request = Requests\PaginateMenuGroups::extend($request);

        $paginator = $this->paginator($this->menuGroups->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreMenuGroup $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreMenuGroup $request)
    {
        $this->authorize('create', MenuGroup::class);

        $input = $request->all();

        $menuGroup = $this->menuGroups->create([
            'name' => $input['name'],
            'body' => $input['body'],
        ]);

        $this->set($menuGroup, $input, [
            'slug',
            'body',
        ]);

        $menuGroup->save();

        return response()->json($menuGroup, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param MenuGroup $menuGroup
     *
     * @return \Illuminate\Http\Response
     */
    public function show(MenuGroup $menuGroup)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $menuGroup);

        return response()->json($menuGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateMenuGroup $request
     * @param MenuGroup $menuGroup
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateMenuGroup $request, MenuGroup $menuGroup)
    {
        $this->authorize('update', $menuGroup);

        $input = $request->all();

        $this->set($menuGroup, $input, [
            'name',
            'slug',
            'body',
        ]);

        $menuGroup->save();

        return response()->json($menuGroup);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param MenuGroup $menuGroup
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuGroup $menuGroup)
    {
        $this->authorize('delete', $menuGroup);

        $menuGroup->delete();

        return response()->json(null, 204);
    }
}
