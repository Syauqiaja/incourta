<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
            <i class="bi bi-trophy-fill me-2"></i> INCOURTA
        </a>
        <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <x-layout.nav-item :href="url('/')">
                    {{ __('Home') }}
                </x-layout.nav-item>
                <x-layout.nav-item :href="'#events'">
                    {{ __('Events') }}
                </x-layout.nav-item>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <x-layout.nav-item :href="route('login')">
                            {{ __('Login') }}
                        </x-layout.nav-item>
                    @endif

                    @if (Route::has('register'))
                        <x-layout.nav-item :href="route('register')">
                            {{ __('Register') }}
                        </x-layout.nav-item>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('player.profile') }}">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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