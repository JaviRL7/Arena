@extends('layouts.plantilla')

@section('title', 'Player Profile')

@section('content')
    <div class="container player-profile-container">
        <div class="row">
            <div class="col-md-12 player-profile-main">
                <div class="player-profile-img">
                    <img src="{{ asset($player->img) }}" alt="" class="player-profile-img">
                    <h1 class="player-profile-nick">{{ $player->nick }}</h1>
                </div>

                <div class="player-profile-photo">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-profile-photo-img">
                    @if ($player->currentTeam())
                        <img src="{{ asset($player->currentTeam()->logo) }}" alt="{{ $player->currentTeam()->name }}"
                            class="player-profile-current-team">
                    @endif
                    <img src="{{ asset($player->role->icono) }}" alt="" class="player-profile-role-icon">
                    <div class="player-profile-information">
                        <h2 class="player-profile-name">{{ $player->nick }}</h2>
                        <h2 class="player-profile-name">{{ $player->name }} {{ $player->lastname1 }}</h2>
                    </div>
                </div>


                <h2 class="titulo">Team History</h2>
                <div class="player-profile-history">
                    @foreach ($player->teams as $index => $team)
                        <div class="contador-contenedor">
                            <h2 class="contador-numero" style="font-family: mol; color: white;">{{ $index + 1 }}</h2>
                        </div>

                        <img src="{{ asset($team->logo) }}" alt="" class="player-profile-history-team">

                        <div style="margin-left: 200px; margin-top: 20px;">
                            <h2 class="fechas" style="font-family: mol; color: white; font-size: 1.5em; margin-right:10px">
                                {{ $team->pivot->start_date }} -
                                @if ($team->pivot->end_date)
                                    {{ $team->pivot->end_date }}
                                @else
                                    {{ $team->pivot->contract_expiration_date > $today ? 'Present' : $team->pivot->contract_expiration_date }}
                                @endif
                            </h2>
                        </div>
                    @endforeach
                </div>
                <h2 class="titulo">Statistics</h2>
                <div class="player-profile-stadistics">
                    <div class="datos" style="background-color: white; border-radius: 15px; padding: 10px; color: #333;">
                        <p style="font-family: mol;">KDA: {{ number_format($player->getKDA(), 2) }}</p>
                    </div>
                    <div class="datos" style="background-color: white; border-radius: 15px; padding: 10px; color: #333;">
                        <p style="font-family: mol;">Total Kills: {{ $player->getTotalKills() }}</p>
                    </div>
                    <div class="datos" style="background-color: white; border-radius: 15px; padding: 10px; color: #333;">
                        <p style="font-family: mol;">Total Assists: {{ $player->getTotalAssists() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2 class="titulo">Favorite Champion</h2>
                <div class="player-profile-stadistics" style="display: flex; align-items: center;">
                    @if($player->mostPlayedChampion())
                        <h1 style="font-family: important; color:white; margin-right: 280px;">{{$player->mostPlayedChampion()->name}}</h1>
                        <img src="{{ asset($player->mostPlayedChampion()->square)}}" alt="" class="rounded-circle">
                    @else
                        <h5 style="font-family: important; color:white; margin-right: 280px;">This player has not played any matches yet.</h5>
                    @endif
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <h1 class="titulo">Fans</h1>

                        @php
                            $isFan = in_array($player->id, [
                                Auth::user()->favorite_player1,
                                Auth::user()->favorite_player2,
                                Auth::user()->favorite_player3,
                                Auth::user()->favorite_player4,
                                Auth::user()->favorite_player5
                            ]);
                        @endphp

                        @if (!$isFan)
                            <form action="{{ route('players.addFan', ['player' => $player->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" data-player-id="{{ $player->id }}">Become a Fan</button>
                            </form>
                        @else
                        <form action="{{ route('players.removeFan', ['player' => $player->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" data-player-id="{{ $player->id }}">Dejar de ser fan</button>
                        </form>
                        @endif

                        @php
                            $fans = \App\Models\User::where('favorite_player1', $player->id)
                                ->orWhere('favorite_player2', $player->id)
                                ->orWhere('favorite_player3', $player->id)
                                ->orWhere('favorite_player4', $player->id)
                                ->orWhere('favorite_player5', $player->id)
                                ->get();
                        @endphp

                        @if ($fans->isEmpty())
                            <h5>This player doesn't have any fans yet.</h5>
                        @else
                            <div style="background-color: blue;">
                                @foreach ($fans as $fan)
                                    <div class="fan">
                                        <h2>{{ $fan->name }}</h2>
                                        <img src="{{ asset($fan->photo) }}" alt="" class="player-profile-img">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                @include('modals.change_favorite')
            </div>


            <div class="col-md-6">
                <h1 class="titulo"> Win rate</h1>

                <div class="owl-carousel owl-theme">
                    @foreach (collect($playerChampionData)->chunk(10) as $chunk)
                        <div class="item">
                            @foreach ($chunk as $championId => $champion)
                            <div class="champion">
                                <img src="{{ asset($champion['image']) }}" alt="{{ $champion['name'] }}">
                                <h4 class="name-champ">{{ $champion['name'] }}</h4>
                                <div class="bar">
                                    <div class="win"
                                        style="width: {{ $champion['stats']['win_percentage'] }}%;">
                                        {{ round($champion['stats']['win_percentage']) }}% W
                                    </div>
                                    <div class="loss"
                                        style="width: {{ $champion['stats']['loss_percentage'] }}%;">
                                        {{ round($champion['stats']['loss_percentage']) }}% L
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
        <script>
            $(document).ready(function() {
                console.log("Documento listo");
                $(".owl-carousel").owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 10,
                    //autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true
                });
            });
        </script>
        <script>
            window.onload = function() {
                var nickElement = document.querySelector('.player-profile-nick');
                var nick = nickElement.textContent;
                if (/\d/.test(nick)) { // Comprueba si el apodo contiene un dígito
                    nickElement.classList.add('digit'); // Añade la clase 'digit' al elemento
                }
            };
        </script>
        <script>

$(document).ready(function() {
    let playerChampionData = @json($playerChampionData);

    for (let championId in playerChampionData) {
        let ctx = document.getElementById('chart-' + championId).getContext('2d');
        let winPercentage = playerChampionData[championId].stats.win_percentage;
        let lossPercentage = playerChampionData[championId].stats.loss_percentage;

        let chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Victorias', 'Derrotas'],
                datasets: [{
                    data: [winPercentage, lossPercentage],
                    backgroundColor: ['blue', 'red'],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
</script>
<script>
$(document).ready(function() {
    $('.btn-primary').click(function(e) {
        e.preventDefault();

        // Guarda el ID del jugador
        var playerId = $(this).data('player-id');

        // Si el botón dice "Dejar de ser fan", entonces quita al jugador de los favoritos
        if ($(this).text() === 'Dejar de ser fan') {
            $.ajax({
                url: '/players/' + playerId + '/removeFan',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Añade el token CSRF para proteger contra ataques CSRF
                },
                success: function(response) {
                    if (response.success) {
                        // Actualiza la página o muestra un mensaje de éxito
                        location.reload();
                    } else {
                        // Muestra un mensaje de error
                        alert('Hubo un error al intentar dejar de ser fan. Por favor, inténtalo de nuevo.');
                    }
                }
            });
        } else {
            // Intenta añadir al jugador a los favoritos
            $.ajax({
                url: '/players/' + playerId + '/addFan',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Añade el token CSRF para proteger contra ataques CSRF
                },
                success: function(response) {
                    if (response.maxFavoritesReached) {
                        // Si ya se han seleccionado 5 jugadores, abre la modal
                        // Obtiene los detalles del jugador actual
                        $.ajax({
                            url: '/players/' + playerId,
                            method: 'GET',
                            success: function(currentPlayer) {
                                // Obtiene los jugadores favoritos del usuario
                                $.ajax({
                                    url: '/players/' + playerId + '/getFavorites',
                                    method: 'GET',
                                    success: function(favoritesResponse) {
                                        // Añade el jugador actual a la respuesta
                                        favoritesResponse.push(currentPlayer);

                                        // Añade los jugadores favoritos a la modal
                                        var favoritesContainer = $('#favorites-container');
                                        favoritesContainer.empty(); // Limpia el contenedor

                                        favoritesResponse.forEach(function(player) {
                                            var playerElement = '<div class="favorite-player">' +
                                                '<img src="' + player.photo +
                                                '" alt="" class="player-profile-img" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">' +
                                                '<h2>' + player.nick + '</h2>' +
                                                '<p style="color: gray;">' + player.name + ' ' + (player.lastname1 || '') + ' ' + (player.lastname2 || '') +
                                                '</p>' +
                                                '<input type="checkbox" class="choose-favorite-checkbox" data-player-id="' +
                                                player.id + '" style="position: absolute; right: 10px;">' +
                                                '</div>';

                                            favoritesContainer.append(playerElement);
                                        });

                                        // Abre la modal
                                        $('#choose-favorites-modal').modal('show');
                                    }
                                });
                            }
                        });
                    } else if (response.success) {
                        // Si el jugador se añadió a los favoritos con éxito, actualiza la página
                        location.reload();
                    } else {
                        // Muestra un mensaje de error
                        alert('Hubo un error al intentar añadir a este jugador a tus favoritos. Por favor, inténtalo de nuevo.');
                    }
                }
            });
        }
    });
});
        </script>

    @endsection
