<!doctype html>

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- HEAD
    ========================================================================================== -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>





    <!-- BODY
    ========================================================================================== -->
    <body>

        <div id="app">

            <!-- navbar -->
            <nav class="navbar border-bottom border-bottom-dark navbar-expand-lg bg-dark fixed-top" data-bs-theme="dark">
                <div class="container-fluid">

                    <!-- titre -->
                    <a class="navbar-brand text-light" href="{{ url('/') }}">
                        SociaLink
                    </a>

                    <!-- menu burger -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto"></ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">

                            <!-- je cache la barre de recherche si utilisateur non connecter / inscrit -->
                            @if (Auth::check())

                                <!-- formulaire recherche posts -->
                                <form class="d-flex me-3" action="{{ route('search') }}" role="search" method="GET">
                                @csrf

                                    <!-- button rechercher -->
                                    <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search" name="search">
                                    <button class="btn btn-outline-primary" type="submit">Rechercher</button>

                                </form>

                            @endif

                            <!-- Authentication Links -->
                            @guest

                                <!-- lien connexion -->
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                    </li>
                                @endif

                                <!-- lien inscritpion -->
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                    </li>
                                @endif

                            <!-- Liens des invités non connectés + connexion et inscription  -->
                            @else

                                <li class="nav-item dropdown">

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->pseudo }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('users.edit', $user = Auth::user() )}}">Mon compte</a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Deconnexion') }}
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

            @yield('content')

        </div>


    </body>


</html>
