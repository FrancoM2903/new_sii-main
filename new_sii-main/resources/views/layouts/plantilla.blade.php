<!DOCTYPE html>
<html lang="es" class="theme-light">

<head>
    <title>CETECH v2</title>
    {{--     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    {{-- <link rel="stylesheet" href={{ asset('css/miestilo.css') }}> --}}
    <link rel="stylesheet" href='/css/miestilo.css'>
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="">
                <figure class="image is-24x24">
                    <img src="/img/itsjr.png" />
                </figure>&nbsp;&nbsp;
                <p>Tec San Juan</p>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="{{ route('home')}}">
                    Inicio
                </a>

            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    {{-- <button id="toggleButton" class="button">Cambiar Modo</button> --}}
                    <div class="buttons">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            <button class="button is-danger is-outlined" type="submit">
                                <strong>Cerrar sesión</strong>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- <h1 class="title is-3">Sistema de Informacion Integral</h1> --}}
    {{--     <div class="container is-fluid" data-theme="light"> --}}
    <div class="container is-fluid">
        @yield('content')
    </div>
</body>

</html>
