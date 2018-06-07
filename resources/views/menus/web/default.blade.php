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

{{--{!! $menu !!}--}}

<ul>
    @foreach($menu->items() as $item)
        @include('belt-menu::menus.web._show')
    @endforeach
</ul>