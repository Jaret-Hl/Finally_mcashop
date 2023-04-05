
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            MCASHOP
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto"></ul>

            <ul class="navbar-nav ms-auto">
                @if(isset($menus))
                @foreach($menus as $menu)
                    <li class="nav-item"><a href="{{$menu->menu_rutas}}">{{ $menu->title }}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</nav>