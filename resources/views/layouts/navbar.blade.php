<nav class="navbar">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://gunlim.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-3xl font-semibold whitespace-nowrap text-white dark:text-white">Gunlim</span>
        </a>

        <ul class="flex space-x-4">
            <li><a href="#" class="text-white font-bold text-lg">Who is the player ?</a></li>
            <li><a href="#" class="text-white font-bold text-lg">Teams</a></li>
            <li><a href="#" class="text-white font-bold text-lg">Competitions</a></li>
            <li><a href="{{ route('players.rankings') }}" class="text-white font-bold text-lg">Rankings</a></li>
            <li><a href="#" class="text-white font-bold text-lg">Calendar</a></li>
        </ul>

        <div class="dropdown">
            <button class="dropbtn text-white font-bold text-lg flex items-center">Iniciar sesión
                <svg class="w-4 h-4 ml-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="#">Perfil</a>
                <a href="#">Cerrar sesión</a>
            </div>
        </div>
    </div>
</nav>
