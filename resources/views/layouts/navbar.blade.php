<!--Navbar-->
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #fffcdc;">
    <div class="container">
        <!--logo-->
        <a class="navbar-brand fs-4 d-flex align-items-center" href="#">
            <img src="/icons/logof.png" alt="Logo" style="height: 50px;">
            <h2 style="font-family: important; color: #e44445">Gunlim</h2>
        </a>

        <!--Button-->
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--side bar-->
        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <!--side bar header-->
            <div class="offcanvas-header border-bottom">
                <h1 class="offcanvas-title" id="offcanvasNavbarLabel">Gunlin</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!--side bar body-->
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center fs-5 flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"  href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('games.index') }}">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('players.rankings') }}">Rankings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('minigame.index') }}">Who's the Player?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#Calendar">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#Calendar">Transfers</a>
                    </li>
                </ul>
                <!--Login-->
                @if (auth()->check())
                    <div class="d-flex justify-content-center align-items-center gap-3 flex-column flex-lg-row">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="margin-top: 5px;">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Perfil</a></li>
                                @if (auth()->user()->admin)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.players.index') }}">Admin
                                            panel</a>
                                    </li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit"><a>Log out</a></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center gap-3 flex-column flex-lg-row">
                        <a href="{{ route('login') }}" class="text-black text-decoration-none">Login</a>
                        <a href="{{ route('register') }}"
                            class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4">Register</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</nav>
