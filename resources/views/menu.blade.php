<nav>
    <ul>
        @if(isset($menus))
        @foreach($menus as $menu)
            <li><a href="{{$menu->menu_rutas}}">{{ $menu->title }}</a></li>
        @endforeach
        @endif
    </ul>
</nav>