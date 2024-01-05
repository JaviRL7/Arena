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
                    @foreach ($years as $year)
                        <button class="year-button" data-year="{{ $year }}">{{ $year }}</button>
                    @endforeach

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

        <script>
        $('.year-button').click(function() {
    var year = $(this).data('year');
    $.get('/teams_show/' + {{ $team->id }} + '/players/' + year, function(data) {
        // Imprime los datos en la consola
        console.log(data);

        // Aquí puedes actualizar tu vista con los jugadores obtenidos
        $('#playersByYear').empty();
        $.each(data, function(i, player) {
            $('#playersByYear').append('<p>' + player.nick + '</p>');
        });
    });
});
        </script>
    @endsection
