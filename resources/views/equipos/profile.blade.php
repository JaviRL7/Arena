@extends('layouts.plantilla')

@section('title', 'Team Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="min-height: 80vh; position: relative;">
                <div style="width: 100%;">
                    <!-- Cabecera con el logo del equipo -->
                    <img src="{{ asset($team->team_photo) }}" alt=""
                        style="border-radius: 15px; border-color:orange; width: 100%;">

                    <div class="team-header" style="background-color: {{ $rgbColor }};">
                        <div class="logo-container">
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}" class="teams-show-team-logo">
                        </div>
                    </div>
                </div>

                <div class="team-information">
                    <h1 class="titulo-team" style="color:{{ $rgbColor }}; ">{{ $team->name }}</h1>
                    <h4 class="titulo-team" style="color:{{ $rgbColor }}; ">{{ $team->competition->name }}</h1>
                </div>
                <br>
                <br>
                <!-- Línea separadora -->
                <div style="height: 5px; background-color: #e44445;"></div>
                <div class="team-players">
                    <h1 class="titulo">Current roster</h1>
                    @foreach ($team->getPlayersDate(\Carbon\Carbon::now()) as $player)
                        <div class="team-profile-player-div" style="background-color:#e44445;">
                            <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                                class="team-profile-player-img">
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
                        <div class="players" id="players-{{ $year }}" style="display: none;">
                            @foreach ($playersByYear[$year] as $player)
                                <p>{{ $player->nick }}</p>
                            @endforeach
                        </div>
                    @endforeach

                    <div id="playersByYear">
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
                $('.players').hide();
                $('#players-' + year).show();
            });
        </script>
    @endsection
