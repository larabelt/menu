@php
    if(is_string($menu)) {
        $menu = Menu::get($menu);
    }
    if (isset($active)) {
        $menu->active($active);
    } else {
        $menu->guessActive();
    }
@endphp

{!! $menu !!}