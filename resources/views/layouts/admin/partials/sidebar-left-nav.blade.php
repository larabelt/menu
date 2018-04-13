@if($auth->can(['create','update','delete'], Belt\Menu\MenuGroup::class))
    <li id="menu-admin-sidebar-left-menu-groups"><a href="/admin/belt/menu/menu-groups"><i class="fa fa-bars"></i> <span>Menus</span></a></li>
@endif