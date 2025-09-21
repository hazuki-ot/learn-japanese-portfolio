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
                                <a href="#" class="nav-link bg-primary rounded px-4 mx-2 text-white fw-bold">ひらがな</a>
                            </li>  
                            
                            <li class="nav-item">
                                <a href="#" class="nav-link bg-warning rounded px-4 mx-2 text-white fw-bold">カタカナ</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link bg-success rounded px-4 mx-2 text-white fw-bold">漢字</a>
                            </li>
                        </ul>
                    @endguest
             
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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