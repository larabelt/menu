@php
    $menu = $section->param('menu');
    $menu = \Belt\Menu\Menu::$menu();
    if ($section->param('active')) {
        $menu->setActive($section->param('active'));
    } else {
        $menu->setActiveFromRequest();
    }
@endphp

<div class="section section-block {{ $section->param('class') }}">
    @include('belt-content::sections.sections._header')
    @include('belt-content::sections.sections._body')
    @include('belt-menu::menus.web._breadcrumbs')
    @include('belt-content::sections.sections._footer')
</div>