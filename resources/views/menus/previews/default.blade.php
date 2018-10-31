@php
    $key = $section->param('menu');
    $menu = $key ? Menu::get($key) : null;
@endphp

@if($menu)
    {!! $menu !!}
@endif