@php
    $key = $section->param('menu');
    $menu = Menu::get($key);
@endphp

@if($menu)
    {!! $menu !!}
@endif