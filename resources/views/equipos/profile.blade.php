@extends('layouts.plantilla')

@section('title', 'Team Profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

    <link rel="stylesheet" href="{{ asset('css/p_profile.css') }}">

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/team/profile.js') }}" defer></script>

@endsection

@section('content')
    <style>

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="min-height: 80vh;">
                <div style="width: 100%;">
                    <!-- Cabecera con el logo del equipo -->
                    <img src="{{ asset($team->team_photo) }}" alt=""
                        style="border-radius: 15px; border-color:orange; width: 100%;">

                    <div class="team-header" style="background-color: {{ $rgbColor }};">
                        <div class="logo-container">
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}" class="teams-show-team-logo">

                        </div>
                        <div class="">
                            <h1 class="titular" style="color: white">{{ $team->name }}</h1>
                            <h4 class="titulo-team" style="color:white">{{ $team->competition->name }}</h1>
                        </div>
                    </div>
                </div>


                @if ($team->getPlayersDate(\Carbon\Carbon::now())->isNotEmpty())

                    <div class="roster-section">
                        <h1 class="titular subrayado roster-title">Current roster</h1>
                        <div class="row">
                            @foreach ($team->getPlayersDate(\Carbon\Carbon::now()) as $player)
                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('players.profile', $player) }}" class="team-profile-card-link"
                                        style="text-decoration: none; color: inherit;">
                                        <div class="team-profile-card-custom">
                                            <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                                                class="team-profile-img-custom">
                                            <div class="team-profile-body-custom">
                                                <h5 class="titular team-profile-title-custom">{{ $player->nick }}</h5>
                                                <p class="subtitular team-profile-text-custom">{{ $player->name }}
                                                    {{ $player->lastname1 }} {{ $player->lastname2 ?? '' }}</p>
                                                <img src="{{ asset($player->role->icono) }}"
                                                    alt="{{ $player->role->name }}" class="team-profile-role-icon-custom">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


                <hr class="custom-hr">
            </div>
            @php
                $valid_years = array_filter($years, function ($year) {
                    return $year < date('Y');
                });
            @endphp

            @if (count($valid_years) > 0)
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="titular subrayado"> History roster</h1>
                        <!-- Años -->
                        <div class="d-flex flex-wrap p-3 rounded" style="background-color: #e44445;">
                            @foreach ($valid_years as $year)
                                <button type="button" class="btn p-2 m-1 text-white year-button titular"
                                    data-year="{{ $year }}" style="background-color: transparent; border: none;">
                                    {{ $year }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Jugadores por año -->
                        @foreach ($valid_years as $year)
                            <div class="players" id="players-{{ $year }}" style="display: none;">
                                @foreach ($playersByYear[$year] as $player)
                                    <a href="{{ route('players.profile', $player) }}" class="player-link"
                                        style="text-decoration: none; color: inherit;">
                                        <div class="player-item-year">
                                            <div class="player-info">
                                                <h2 class="titular">{{ $player->nick }}</h2>
                                                <p class="subtitular">{{ $player->name }} {{ $player->lastname1 }}
                                                    {{ $player->lastname2 ?? '' }}</p>
                                            </div>
                                            <img src="{{ asset($player->role->icono) }}" alt="{{ $player->role->name }}"
                                                class="team-profile-role-icon-custom">
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach

                        <div id="playersByYear">
                        </div>
                    </div>

            @endif
            @if (count($championData) > 0)
                <div class="col-md-6">

                    <h1 class="titular subrayado"> Win rate</h1>

                    <div class="owl-carousel owl-theme">
                        @foreach (collect($championData)->chunk(10) as $chunk)
                            <div class="item">
                                @foreach ($chunk as $championId => $champion)
                                    <div class="champion titular">
                                        <img src="{{ asset($champion['image']) }}" alt="{{ $champion['name'] }}"
                                            class="champion-win-rate">
                                        <h4 class="titular">{{ $champion['name'] }}</h4>
                                        <div class="bar" style="margin: 10px">
                                            @if ($champion['stats']['win_percentage'] > 0)
                                                <div class="win"
                                                    style="width: {{ $champion['stats']['win_percentage'] }}%;">
                                                    {{ round($champion['stats']['win_percentage']) }}% W
                                                </div>
                                            @endif
                                            @if ($champion['stats']['loss_percentage'] > 0)
                                                <div class="loss"
                                                    style="width: {{ $champion['stats']['loss_percentage'] }}%;">
                                                    {{ round($champion['stats']['loss_percentage']) }}% L
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>


                </div>
        </div>
        @endif
    </div>
    @php
        $past_series = $series->where('date', '<', now())->filter(function ($serie) use ($team) {
            return $serie->team_1_id == $team->id || $serie->team_2_id == $team->id;
        });
    @endphp

    @if ($past_series->isNotEmpty())
        <hr class="custom-hr">
        <div class="row">
            <div class="col-md-12">

                <h1 class="titular subrayado"> Series history</h1>

                @foreach ($past_series as $serie)
                    <a href="{{ route('series.show', $serie) }}" style="text-decoration: none; color: inherit;">
                        <div class="serie" style="margin-top: 30px">
                            <div class="team">
                                <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_1->name }}">
                            </div>
                            <div class="">
                                <h2 class="titular">{{ $serie->getResultSerie() }}</h2>
                            </div>
                            <div class="team">
                                <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}">
                            </div>
                        </div>
                    </a>
                    <hr class="custom-hr2"> <!-- Línea horizontal -->
                @endforeach

            </div>
        </div>
    @endif
    <div class="row" style="margin-top: 40px">
        <div class="col-md-12" style="margin-bottom: 50px">
            <div style="height: 5px; background-color: #e44445;"></div>
            <h1 class="titular subrayado">Fans</h1>

            @php
                $fans = \App\Models\User::where('favorite_team', $team->id)->get();
                $user = Auth::user();
                session(['url.intended' => url()->current()]);

            @endphp

            @if ($user)
                @if ($user->favorite_team == $team->id)
                    <form method="POST" action="{{ route('teams.unfan', $team) }}" style="margin-bottom: 20px;">
                        @csrf
                        <button type="submit" class="btn btn-boton8">Stop Being a Fan</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('teams.becomeFan', $team) }}" style="margin-bottom: 20px;">
                        @csrf
                        <button type="submit" class="btn btn-boton7">Become a fan</button>
                    </form>
                @endif
            @else
                <div style="margin-bottom: 20px;" class="titular">
                    Please login for become a fan<button onclick="location.href='{{ route('login') }}'"
                        class="btn btn-boton6" style="margin: 0%; margin-left:10px;">Login</button>

                </div>
            @endif

            @if ($fans->isEmpty())
                <h5>This team doesn't have any fans yet.</h5>
            @else
                <x-fans-section :fans="$team->getFansAttribute()" />
            @endif
        </div>
    </div>
    <script>
        window.championData = @json($championData);
    </script>
@endsection
