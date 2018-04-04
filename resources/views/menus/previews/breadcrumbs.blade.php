@php
    $key = $section->param('menu');
    $menu = Menu::get($key);
@endphp

@if($menu)
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        @foreach($menu->breadcrumbs() as $crumb)
            <li><a href="{{ $crumb->uri }}">{{ $crumb->label }}</a></li>
        @endforeach
    </ol>
@endif