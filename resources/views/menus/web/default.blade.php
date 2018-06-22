@php
    $class = $class ?? '';
    $menu = is_string($menu) ? Menu::get($menu) : $menu;
    if (isset($active)) {
        $menu->active($active);
    } else {
        $menu->guessActive();
    }
@endphp

<ul class="{{ $class }}">
    @foreach($menu->items() as $item)
        @include('belt-menu::menus.web._show')
    @endforeach
</ul>