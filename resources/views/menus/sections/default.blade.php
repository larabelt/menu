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
    @include('belt-content::sections.sections._header')
    @include('belt-content::sections.sections._body')
    @include('belt-menu::menus.web.default')
    @include('belt-content::sections.sections._footer')
</div>