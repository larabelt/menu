@php
    $key = $section->param('menu');
    $menu = Menu::get($key);
    if ($active = $section->param('active')) {
        $menu->active($active);
    } else {
        //$menu->setActiveFromRequest();
    }
@endphp

<div class="section section-block {{ $section->param('class') }}">
    @include('belt-content::sections.sections._heading')
    @include('belt-content::sections.sections._before')
    @include('belt-menu::menus.web.breadcrumbs')
    @include('belt-content::sections.sections._after')
</div>