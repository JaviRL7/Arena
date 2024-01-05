@extends('layouts.plantilla')

@section('title', 'Team Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="min-height: 80vh; position: relative;">
                <div style="width: 100%;">
                    <!-- Cabecera con el logo del equipo -->
                    <img src="{{asset($team->team_photo)}}" alt="" style="border-radius: 15px; border-color:orange; width: 100%;">

                    <div class="team-header" style="background-color: {{ $rgbColor }};">
                        <div class="logo-container">
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}" class="teams-show-team-logo">
                        </div>
                    </div>
                </div>

                <div class="team-information">
                    <h1 class="titulo-team" style="color:{{ $rgbColor }}; ">{{$team->name}}</h1>
                    <h4 class="titulo-team" style="color:{{ $rgbColor }}; ">{{$team->competition->name}}</h1>
                </div>
                <br>
                <br>
                <!-- Línea separadora -->
                    <div style="height: 5px; background-color: #e44445;"></div>
                    <div class="team-players">
                        <h1 class="titulo">Current roster</h1>
                        @foreach ($team->getPlayersDate(\Carbon\Carbon::now()) as $player)
                            <div class="team-profile-player-div" style="background-color:#e44445;">
                                <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="team-profile-player-img">
                                <div class="team-profile-player-info">
                                    <h1>{{ $player->nick }}</h1>
                                    <img src="{{ asset($player->role->icono_w) }}" alt="{{ $player->role->name }}">
                                </div>
                            </div>
                        @endforeach
                    </div>



            </div>
            <div class="row">
                <div class="md-col-6">
                    <!-- Botones de año -->
                    @for ($year = date('Y') - 1; $year >= 2000; $year--)
                        @if (count($team->getPlayersDate(new Date($year, 0, 1))) > 0)
                            <button onclick="getPlayersByYear({{ $year }})">{{ $year }}</button>
                        @endif
                    @endfor

                    <!-- Div para los jugadores del año seleccionado -->
                    <div id="playersByYear">
                        <!-- Los jugadores del año seleccionado se mostrarán aquí -->
                    </div>
                </div>
                <div class="md-col-6">
                    <!-- Puedes agregar contenido adicional aquí -->
                </div>
            </div>
        </div>
    </div>
    <script>
        function getPlayersByYear(year) {
            // Usa la función getPlayersDate($date) para obtener los jugadores del año seleccionado
            // Asegúrate de reemplazar 'team' con la instancia actual del equipo
            var players = team.getPlayersDate(new Date(year, 0, 1));

            var playersDiv = document.getElementById('playersByYear');
            playersDiv.innerHTML = '';

            players.forEach(function(player) {
                var playerDiv = document.createElement('div');
                playerDiv.className = 'team-profile-player-div';
                playerDiv.style.backgroundColor = '#e44445';

                var playerImg = document.createElement('img');
                playerImg.src = player.photo;
                playerImg.alt = player.nick;
                playerImg.className = 'team-profile-player-img';

                var playerInfo = document.createElement('div');
                playerInfo.className = 'team-profile-player-info';

                var playerNick = document.createElement('h1');
                playerNick.textContent = player.nick;

                var playerRoleIcon = document.createElement('img');
                playerRoleIcon.src = player.role.icono_w;
                playerRoleIcon.alt = player.role.name;

                playerInfo.appendChild(playerNick);
                playerInfo.appendChild(playerRoleIcon);

                playerDiv.appendChild(playerImg);
                playerDiv.appendChild(playerInfo);

                playersDiv.appendChild(playerDiv);
            });
        }
            </script>
@endsection

