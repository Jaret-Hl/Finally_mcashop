<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pagina Principal') }}</title>
    @yield('css')
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>

<body>
    @yield('setmenu')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    MCASHOP
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @role('Admin|Supervisor')
                                <li><a class="nav-link" href="{{ route('users.index') }}">Usuarios</a></li>
                            @endrole
                            @role('Admin|Supervisor')
                                <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                            @endrole
                            @role('Admin')
                                <li><a class="nav-link" href="/menu">Menus</a></li>
                            @endrole
                            {{-- @role('Admin|Supervisor')
                        <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li>
                        @endrole --}}
                            @role('Admin|Vendedor|Vendedor2')
                                <li><a class="nav-link" href="{{ route('cotizaciones.index') }}">Cotizaciones</a></li>
                            @endrole
                            @role('Admin|Vendedor|Vendedor2')
                                <li><a class="nav-link" href="{{ route('permissions.index') }}">Permission</a></li>
                            @endrole
                            @role('Admin|Vendedor')
                                <li><a class="nav-link" href="/cat_clientes">Clientes</a></li>
                            @endrole
                            @role('Admin|Vendedor')
                                <li><a class="nav-link" href="/Articulos">Articulos</a></li>
                            @endrole
                            @role('Admin|Supervisor')
                                <li><a class="nav-link" href="/cat_marcas">Marcas</a></li>
                            @endrole
                            @role('Admin|Supervisor')
                                <li><a class="nav-link" href="/catalogo_proveedores">Proveedores</a></li>
                            @endrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->id }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                        @endguest
                    </ul>
                </div>

            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @yield('js')
</body>

</html>
