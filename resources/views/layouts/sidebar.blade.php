<div class="d-flex flex-column flex-shrink-0 p-3 sidebar-estilo" style="height: 90vh;">
    <h1 class="titulo-estilo">Panel admin</h1>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2 enlace-estilo" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2 enlace-estilo" href="{{ route('admin.games.index') }}" >Games</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2 enlace-estilo" href="{{ route('admin.players.index') }}" >Players</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2 enlace-estilo" href="{{ route('admin.teams.index') }}" >Teams</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2 enlace-estilo" href="#Calendar" >Calendar</a>
        </li>
    </ul>
    <hr>
</div>
