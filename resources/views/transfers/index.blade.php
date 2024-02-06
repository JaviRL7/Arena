@extends('layouts.plantilla')

@section('title', 'Transfers index')

@section('content')

<div class="container-fluid" style="padding: 0 7%; min-height: 80vh"> <!-- Ajusta el padding para crear un margen del 5% -->
    <div class="row">

        </div>
        <div class="row">
            <div class="col-md-9 team-grid">
                <div class="col-md-12 selecor-league">

                    <h1 class="titular subrayado">
                        Leagues
                    </h1>
                    <br>

                    <div class="btn-group" role="group" aria-label="Competitions">
                        <button type="button" class="btn btn-secondary btn-large competition-button" data-id="all">
                            All
                        </button>
                        @foreach ($competitions as $competition)
                            @if ($competition->id != 2 && $competition->id != 6)
                                <button type="button" class="btn btn-secondary btn-large competition-button"
                                    data-id="{{ $competition->id }}">
                                    {{ $competition->name }}
                                </button>
                            @endif
                        @endforeach
                    </div>

                </div>

                @foreach ($teams as $team)
                    <div class="team-container" data-league="{{ $team->league_id }}" style="display: none;">
                        <div class="logo-container2">
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}" class="team-logo-small">
                            <!-- Logo del equipo en pequeño -->
                        </div>
                        <h3 class="titular team-name">{{ $team->name }}</h3>
                        <hr class="team-separator"> <!-- Separador rojo -->
                        <table class="my-custom-table">
                            @php
                                $date = \Carbon\Carbon::now()
                                    ->subYear()
                                    ->setMonth(12)
                                    ->setDay(30)
                                    ->toDateString();
                            @endphp
                            @foreach ($team->getPlayersDate($date) as $player)
                                <tr>
                                    <td><img src="{{ $player->role->icono }}" class="role-icon"></td>
                                    <td class="titular" style="font-size: 25px">{{ $player->nick }}</td>
                                    <td><i class="fas fa-arrow-right fa-sm"></i></td>
                                    <!-- Icono Font Awesome con tamaño pequeño -->
                                    @foreach ($team->getPlayersDate(\Carbon\Carbon::now()->toDateString()) as $oldPlayer)
                                        @if ($oldPlayer->role->id == $player->role->id && $oldPlayer->pivot->substitute == false)
                                            <td class="titular" style="font-size: 25px">{{ $oldPlayer->nick }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endforeach
            </div>

            <div class="col-md-3">
                <h1 class="titular subrayado" style="margin-top: 65px">
                    Transfers
                </h1>
                @foreach ($transfers as $transfer)
                    <div class="transfers-container">
                        <div>
                            @if ($transfer->team_from->id == $transfer->team_to->id)
                                <div class="mb-2">
                                    <p class="comentarios">Renew</p>
                                    <div class="team-info">
                                        <img src="{{ asset($transfer->team_from->logo) }}" alt="">
                                        <p>{{ $transfer->team_from->name }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="mb-2">
                                    <p class="comentarios">Transfer</p>

                                    <p class="transfer-label subtitular">Leaves</p>
                                    <div class="team-info">

                                        <img src="{{ asset($transfer->team_from->logo) }}" class="" alt="">
                                        <p>{{ $transfer->team_from->name }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="transfer-label subtitular">Joins</p>
                                    <div class="team-info">

                                        <img src="{{ asset($transfer->team_to->logo) }}" class="team-logo-small" alt="">
                                        <p>{{ $transfer->team_to->name }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="player-info" @if ($transfer->team_from->id == $transfer->team_to->id) style="margin-top: 40px;" @endif>
                            <h3>{{ $transfer->player->nick }}</h3>
                            <img src="{{ asset($transfer->player->role->icono) }}" alt="">
                        </div>
                    </div>
                    <hr class="custom-hr2">
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Muestra todos los elementos .team-container cuando se carga la página
            $('.team-container').show();

            $('.competition-button').click(function() {
                // Elimina la clase 'active' de todos los botones
                $('.competition-button').removeClass('active');
                // Añade la clase 'active' al botón que se ha hecho clic
                $(this).addClass('active');

                var leagueId = $(this).data('id');
                if (leagueId == "all") {
                    $('.team-container').show();
                } else {
                    $('.team-container').hide();
                    $('.team-container[data-league="' + leagueId + '"]').show();
                }
            });

            // Obtiene el parámetro 'view' de la URL
            var urlParams = new URLSearchParams(window.location.search);
            var view = urlParams.get('view');

            // Si hay un parámetro 'view', simula un clic en el botón correspondiente
            if (view) {
                $('.competition-button[data-id="' + view + '"]').click();
            } else {
                // Si no hay un parámetro 'view', simula un clic en el botón "All"
                $('.competition-button[data-id="all"]').click();
            }
        });
    </script>
@endsection
