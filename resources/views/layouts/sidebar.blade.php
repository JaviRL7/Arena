<div class="d-flex flex-column flex-shrink-0 p-3 sidebar-estilo" style="width: 400px; height: 100vh;">
    <h1 class="titular subrayado sidebar-cabezado">Admin panel</h1>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item sidebar-item">
            <a class="sidebar-link titular" href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link titular" href="{{ route('admin.games.index') }}"><i class="fas fa-gamepad"></i> Games</a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link titular" href="{{ route('admin.players.index') }}"><i class="fas fa-users"></i> Players</a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link titular" href="{{ route('admin.teams.index') }}"><i class="fas fa-users-cog"></i> Teams</a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link titular" href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i> Users</a>
        </li>
    </ul>

</div>
