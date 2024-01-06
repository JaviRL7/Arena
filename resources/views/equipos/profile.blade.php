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
                <div class="col-md-6">
                    <div style="height: 5px; background-color: #e44445;"></div>
                    <h1 class="titulo"> History roster</h1>
                    <!-- Años -->
                    <div class="d-flex flex-wrap p-3 rounded" style="background-color: #e44445;">
                        @foreach ($years as $year)
                            @if ($year < date('Y'))
                                <button type="button" class="btn p-2 m-1 text-white year-button"
                                    data-year="{{ $year }}" style="background-color: transparent; border: none;">
                                    {{ $year }}
                                </button>
                            @endif
                        @endforeach
                    </div>

                    <!-- Jugadores por año -->
                    @foreach ($years as $year)
                        <div class="players" id="players-{{ $year }}" style="display: none;">
                            @foreach ($playersByYear[$year] as $player)
                                <p>{{ $player->nick }}</p>
                            @endforeach
                        </div>
                    @endforeach

                    <div id="playersByYear">
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="height: 5px; background-color: #e44445;"></div>
                    <h1 class="titulo"> Win rate</h1>

                    <div class="owl-carousel owl-theme">
                        @foreach (collect($championData)->chunk(10) as $chunk)
                            <div class="item">
                                @foreach ($chunk as $championId => $champion)
                                    <div class="champion">
                                        <img src="{{ asset($champion['image']) }}" alt="{{ $champion['name'] }}">
                                        <h2>{{ $champion['name'] }}</h2>
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
                $('.year-button').click(function() {
                    var year = $(this).data('year');
                    $('.players').hide();
                    $('#players-' + year).show();
                });
            </script>
            <script>
                let championData = @json($championData);

                for (let championId in championData) {
                    let ctx = document.getElementById('chart-' + championId).getContext('2d');
                    let winPercentage = championData[championId].stats.win_percentage;
                    let lossPercentage = championData[championId].stats.loss_percentage;

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
            </script>

        @endsection
