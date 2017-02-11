@php
    $menu = $section->param('menu');
    $menu = \Ohio\Menu\Menu::$menu();
    if ($section->param('active')) {
        $menu->setActive($section->param('active'));
    } else {
        $menu->setActiveFromRequest();
    }
@endphp

<div class="section section-block {{ $section->param('class') }}">
    @include('ohio-content::section.sections._header')
    @include('ohio-content::section.sections._body')
    @include('ohio-menu::menu.web._show')
    @include('ohio-content::section.sections._footer')
</div>