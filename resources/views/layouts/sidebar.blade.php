<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="height: 120vh;">
    <span class="fs-4">Panel admin</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2" href="#Home" style="color: black; font-size: 18px; height: 40px;">Home</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2" href="{{ route('admin.games.index') }}" style="color: black; font-size: 18px; height: 40px;">Games</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2" href="{{ route('admin.players.index') }}" style="color: black; font-size: 18px; height: 40px;">Players</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2" href="{{ route('admin.teams.index') }}" style="color: black; font-size: 18px; height: 40px;">Teams</a>
        </li>
        <li class="nav-item" style="margin-bottom: 10px;">
            <a class="nav-link mx-2" href="#Calendar" style="color: black; font-size: 18px; height: 40px;">Calendar</a>
        </li>
    </ul>
    <hr>
</div>
