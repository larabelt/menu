@if(Auth::user()->can('edit', Belt\Menu\MenuGroup::class))
    <li><a href="/admin/belt/menu/menu-groups"><i class="fa fa-bars"></i> <span>Menus</span></a></li>
@endif