<ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    @foreach($menu->breadcrumbs() as $crumb)
        <li><a href="{{ $crumb->uri }}">{{ $crumb->label }}</a></li>
    @endforeach
</ol>