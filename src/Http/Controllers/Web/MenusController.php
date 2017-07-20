<?php

namespace Belt\Menu\Http\Controllers\Web;

use Menu;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Menu\MenuGroup;

/**
 * Class MenusController
 * @package Belt\Menu\Http\Controllers\Web
 */
class MenusController extends BaseController
{

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display the specified resource.
     *
     * @param  MenuGroup $menuGroup
     *
     * @return \Illuminate\View\View
     */
    public function show(MenuGroup $menuGroup)
    {
        $menu = Menu::get($menuGroup->slug);

        return view('belt-menu::menus.web.show', compact('menu'));
    }

}