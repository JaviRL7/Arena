<style>
    .offcanvas {
    background-color: #181414; /* Negro */
}

/* Si quieres también cambiar el color del texto dentro del sidebar */
.offcanvas .navbar-nav .nav-link {
    color: #fff; /* Blanco */
}

/* Opcional: Si quieres cambiar el color del fondo de los elementos al pasar el mouse */
.offcanvas .navbar-nav .nav-link:hover {
    background-color: #333; /* Un gris oscuro para el efecto hover */
}
</style>
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #2c2c26; padding: 0 15px;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fs-4 d-flex align-items-center me-5" href="#"
            style="margin-top: 10px; margin-left: 90px;">
            <img src="/icons/logofinal.png" alt="Logo" style="height: 50px;">
            <h2 style="font-family: mol; color: whitesmoke; margin-left: 20px; margin-right: 50px;">Gunlim</h2>
        </a>

        <!-- Botón para versión móvil -->
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Sidebar -->
        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <!-- Encabezado de Sidebar -->
            <div class="offcanvas-header border-bottom">
                <h1 class="offcanvas-title" id="offcanvasNavbarLabel">Gunlin</h1>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <!-- Cuerpo de Sidebar -->
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <!-- Enlaces de navegación -->
                <ul class="navbar-nav justify-content-lg-start fs-5 flex-grow-1 pe-3">
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('home') ? 'active-link' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('series.index') ? 'active-link' : '' }}" href="{{ route('series.index') }}">Series</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('players.rankings') ? 'active-link' : '' }}" href="{{ route('players.rankings') }}">Rankings</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('minigame.index') ? 'active-link' : '' }}" href="{{ route('minigame.index') }}">Esportle</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('calendar') ? 'active-link' : '' }}" href="{{ route('calendar') }}">Calendar</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('teams.index') ? 'active-link' : '' }}" href="{{ route('teams.index') }}">Teams</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('players.show_players') ? 'active-link' : '' }}" href="{{ route('players.show_players') }}">Players</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link navbar-link mx-2 {{ Request::routeIs('transfers.index') ? 'active-link' : '' }}" href="{{ route('transfers.index') }}">Transfers</a>
                    </li>
                </ul>

                <!-- Contenedor para alinear el botón de alternar y la sección de login/usuario -->
                <div class="d-flex justify-content-lg-end align-items-center" style="margin-right: 50px;">
                    <!-- Botón de alternar modos claro/oscuro -->
                    <div class="theme-switch-wrapper me-3" style="display: flex; align-items: center; margin-right: 200px; margin-top: 10px;">

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                            <label class="form-check-label dark-mode-label" for="darkModeSwitch">
                                <i class="fas fa-moon"></i>
                            </label>
                        </div>
                    </div>

                    <!-- Sección de login/usuario -->
                    @if (auth()->check())
                        <div class="d-flex align-items-center gap-3 flex-column flex-lg-row">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span style="margin-top: 5px;">{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.index', auth()->user()) }}">Profile</a></li>
                                    @if (auth()->user()->admin)
                                        <li><a class="dropdown-item" href="{{ route('admin.players.index') }}">Admin panel</a></li>
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
                        <div class="d-flex align-items-center gap-3 flex-column flex-lg-row">
                            <a href="{{ route('login') }}" class="text-white text-decoration-none login-link">Login</a>
                            <a href="{{ route('register') }}" class="text-white text-decoration-none px-3 py-1 bg-red rounded-4 register-link">Register</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const body = document.body;
        const toggle = document.getElementById('darkModeSwitch');

        // Cargar y aplicar preferencia
        const darkMode = localStorage.getItem('darkMode');
        if (darkMode === 'enabled') {
            body.classList.add('dark-mode');
            toggle.checked = true;
        }

        toggle.addEventListener('click', function () {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', null);
            }
        });
    });
</script>
