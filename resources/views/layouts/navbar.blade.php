<nav class="bg-blue-500 border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://gunlim.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-3xl font-semibold whitespace-nowrap text-white dark:text-white">Gunlim</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <ul class="flex space-x-4">
            <ul class="flex space-x-4">
                <li>
                    <a href="#" class="text-white font-bold text-lg">Home</a>
                </li>
                <li>
                    <a href="#" class="text-white font-bold text-lg">Home</a>
                </li>
                <li>
                    <a href="#" class="text-white font-bold text-lg">Home</a>
                </li>
                <li>
                    <a href="#" class="text-white font-bold text-lg">Home</a>
                </li>
                <li>
                    <a href="#" class="text-white font-bold text-lg">Home</a>
                </li>
            </ul>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white font-bold text-lg flex items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                        <svg class="w-4 h-4 ml-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="text-white font-bold text-lg" href="#">Perfil</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li><a class="text-white font-bold text-lg" href="#">Cerrar sesión</a></li>
                        </form>
                    </ul>
                </li>
            @else
                <span class="nav-link text-white font-bold text-lg">
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                </span>
            @endif
        </ul>
    </div>
</nav>

