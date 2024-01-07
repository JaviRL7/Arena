@extends('layouts.plantilla')

@section('title', 'Transfers index')

@section('content')

    <div class="container-fluid" style="min-height: 80vh">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-9 team-grid">
                <div class="col-md-12 selecor-league">

                    <h1 class="titulo">
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
                        <h3 class="titulo-tabla-transfer">{{ $team->name }}</h3>
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
                                    <td><img src="{{ $player->role->icono_w }}"></td>
                                    <td>{{ $player->nick }}</td>
                                    <td><img src="{{ asset('material/flecha_derecha.png') }}" alt=""
                                            class="arrow inverted"></td>
                                    @foreach ($team->getPlayersDate(\Carbon\Carbon::now()->toDateString()) as $oldPlayer)
                                        @if ($oldPlayer->role->id == $player->role->id)
                                            <td>{{ $oldPlayer->nick }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endforeach
            </div>

            <div class="col-md-3">
                <h1 class="titulo" style="margin-top: 65px">
                    Transfers
                </h1>
                @foreach ($transfers as $transfer)
                    <div class="transfers-container">
                        <div>
                            @if ($transfer->team_from->id == $transfer->team_to->id)
                                <div class="mb-2">
                                    <p class="transfer-label">Renew</p>
                                    <div class="team-info">
                                        <img src="{{ asset($transfer->team_from->logo) }}" alt="">
                                        <p>{{ $transfer->team_from->name }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="mb-2">
                                    <p class="transfer-label">Leaves</p>
                                    <div class="team-info">
                                        <div class="status-circle bg-red-500">
                                            <img src="{{ asset('material/flecha2.png') }}" alt="">
                                        </div>
                                        <img src="{{ asset($transfer->team_from->logo) }}" alt="">
                                        <p>{{ $transfer->team_from->name }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="transfer-label">Joins</p>
                                    <div class="team-info">
                                        <div class="status-circle bg-green-500">
                                            <img src="{{ asset('material/flecha1.png') }}" alt="">
                                        </div>
                                        <img src="{{ asset($transfer->team_to->logo) }}" alt="">
                                        <p>{{ $transfer->team_to->name }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="player-info" @if ($transfer->team_from->id == $transfer->team_to->id) style="margin-top: 40px;" @endif>
                            <h3>{{ $transfer->player->nick }}</h3>
                            <img src="{{ asset($transfer->player->role->icono_w) }}" alt="">
                        </div>
                    </div>
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
