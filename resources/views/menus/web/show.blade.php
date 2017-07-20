@extends('belt-core::layouts.web.main')

@section('main')

    <div class="container">
        <ul>
            @foreach($menu->items() as $item)
                @include('belt-menu::menus.web._show')
            @endforeach
        </ul>
    </div>

@endsection