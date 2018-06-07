<li><a href="{{ $item->getUri() }}" target="{{ $item->getLinkAttribute('target') ?: 'default' }}">{{ $item->getLabel() }}</a></li>
@if($item->hasChildren())
    <ul>
        @foreach($item->getChildren() as $child)
            @include('belt-menu::menus.web._show', ['item' => $child])
        @endforeach
    </ul>
@endif