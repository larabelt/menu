<ol class="breadcrumb">
    @foreach($menu->breadcrumbs() as $crumb)
        <li>{!! $crumb !!}</li>
    @endforeach
</ol>