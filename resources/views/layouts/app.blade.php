<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="{{ route('letter.hiragana.home') }}" class="nav-link bg-primary rounded px-4 mx-2 text-white fw-bold">ひらがな</a>
                            </li>  
                            
                            <li class="nav-item">
                                <a href="{{ route('letter.katakana.home') }}" class="nav-link bg-warning rounded px-4 mx-2 text-white fw-bold">カタカナ</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('letter.kanji.home') }}" class="nav-link bg-success rounded px-4 mx-2 text-white fw-bold">漢字</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('pictures.home') }}" class="nav-link bg-info rounded px-4 mx-2 text-white fw-bold">pictures</a>
                            </li>
                        </ul>
                    @endguest
             
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        {{-- session end --}}
                        @guest
                        <li class="nav-item">
                            <form action="{{ route('end.session') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn"><i class="fa-solid fa-skull-crossbones" style="color: #eb3b0f;"></i></button>
                            </form>
                        </li>
                        @endguest
                        {{-- Go to Home --}}
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="fa-solid fa-house icon-sm text-dark"></i>
                            </a>
                        </li>

                        {{-- Acount --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-ghost" style="color: #B197FC;"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                {{-- go to admin page--}}
                                @guest
                                    <a href="{{ route('login') }}" class="dropdown-item">
                                        <i class="fas fa-user"></i> Go to Admin
                                    </a>
                                @endguest
                                 
                                {{-- Logout --}}
                                @auth
                                    <a href="{{ route('admin.home') }}" class="dropdown-item">
                                        <i class="fa-solid fa-house icon-sm text-dark"></i> Home
                                    </a>

                                    <hr class="dropdown-divider">

                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fa-solid fa-right-from-bracket"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    {{--below shows only admin page --}}
                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.pictures') }}" class="list-group-item {{ request()->is('admin/pictures') ? 'active' : ''}}">
                                    <i class="fa-solid fa-dog" style="color: #f028df;"></i> &nbsp;&nbsp;pictures
                                </a>
                                <a href="{{ route('admin.hiragana') }}" class="list-group-item {{ request()->is('admin/hiragana') ? 'active' : ''}}">
                                    <i class="fa-solid fa-dove" style="color: #63E6BE;"></i> &nbsp;&nbsp;ひらがな
                                </a>
                                <a href="{{ route('admin.katakana') }}" class="list-group-item {{ request()->is('admin/katakana') ? 'active' : ''}}">
                                    <i class="fa-solid fa-dragon" style="color: #FFD43B;"></i> &nbsp;&nbsp;カタカナ
                                </a>
                                <a href="{{ route('admin.kanji') }}" class="list-group-item {{ request()->is('admin/kanji') ? 'active' : ''}}">
                                    <i class="fa-solid fa-horse" style="color: #2c12f3;"></i> &nbsp;&nbsp;漢字
                                </a>
                                <hr class="list-group-divider">
                                <a href="{{ route('admin.category') }}" class="list-group-item {{ request()->is('admin/category') ? 'active' : ''}}">
                                    <i class="fa-solid fa-list"></i> &nbsp;&nbsp;Category
                                </a>
                                <a href="{{ route('admin.language') }}" class="list-group-item {{ request()->is('admin/language') ? 'active' : ''}}">
                                    <i class="fa-solid fa-list"></i> &nbsp;&nbsp;Language
                                </a>
                                <a href="{{ route('admin.sound') }}" class="list-group-item {{ request()->is('admin/sound') ? 'active' : ''}}">
                                    <i class="fa-solid fa-list"></i> &nbsp;&nbsp;Sound
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
