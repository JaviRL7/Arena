@extends('layouts.plantilla')

@section('title', 'Player Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/p_profile.css') }}">

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/players/profile.js') }}" defer></script>

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container-new">
                    {{-- Encabezado del perfil con la imagen de fondo del jugador --}}
                    <div class="profile-header-new" style="background: url('{{ asset($player->img) }}') no-repeat center calc(20%); background-size: cover;"></div>


                    {{-- Foto principal del jugador --}}
                    <div class="profile-picture-container">
                        <div class="player-img-container">
                            <img src="{{ asset($player->photo) }}" alt="Foto del jugador" class="player-img">
                        </div>
                    </div>

                    {{-- Información principal del jugador --}}
                    <div class="profile-info-new">
                        <div class="d-flex align-items-center">
                            <h1 class="username">{{ $player->nick }}</h1>
                        </div>

                        <div class="d-flex align-items-center">
                            <h3 class="comentarios">{{ $player->name }} {{ $player->lastname1 }}
                                {{ $player->lastname2 ?? '' }}</h3>
                            <img src="{{ asset($player->role->icono) }}" alt="{{ $player->role->name }}"
                                class="role-icon">
                        </div>

                        @if ($player->birth_date)
                            <div class="d-flex align-items-center">
                                <p class="user-birthday comentarios">
                                    <i class="fas fa-birthday-cake"></i> {{ date('F jS', strtotime($player->birth_date)) }}
                                </p>
                            </div>
                        @endif

                        @if ($player->currentTeam())
                            <div class="d-flex align-items-center mb-2">
                                <h3 class="comentarios">Current Team: </h3>
                                <h2 class="username mx-2">{{ $player->currentTeam()->name }}</h2>
                                <img src="{{ asset($player->currentTeam()->logo) }}"
                                    alt="{{ $player->currentTeam()->name }}" class="team-logo">
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <p class="comentarios mr-4">Start Date:
                                    {{ date('F jS, Y', strtotime($player->currentTeam()->pivot->start_date)) }}</p>
                                <p class="comentarios">Contract Expiration Date:
                                    {{ date('F jS, Y', strtotime($player->currentTeam()->pivot->contract_expiration_date)) }}
                                </p>
                            </div>
                        @endif
                        <hr class="custom-hr">
                        <h2 class="titular subrayado">Team History</h2>
                        <div class="team-history-container">
                            @foreach ($player->teams as $index => $team)
                                <div class="team-history-item">
                                    <span class="team-number">{{ $index + 1 }}</span>
                                    <img src="{{ asset($team->logo) }}" alt="" class="team-logo">
                                    <div class="team-history-dates">
                                        <h5 class="subtitular">
                                            {{ $team->pivot->start_date }} -
                                            @if ($team->pivot->end_date)
                                                {{ $team->pivot->end_date }}
                                            @else
                                                {{ $team->pivot->contract_expiration_date > $today ? 'Present' : $team->pivot->contract_expiration_date }}
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="custom-hr">
                        <h2 class="titular subrayado">Statistics</h2>
                        <div class="player-statistics-container">
                            <div class="titular">
                                <p>KDA: {{ number_format($player->getKDA(), 2) }}</p>
                            </div>
                            <div class="titular">
                                <p>Total Kills: {{ $player->getTotalKills() }}</p>
                            </div>
                            <div class="titular">
                                <p>Total Assists: {{ $player->getTotalAssists() }}</p>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="titular subrayado">Favorite Champion</h2>
                                    <div class="champion-container">
                                        @if ($player->mostPlayedChampion())
                                            <div class="champion-photo-container">
                                                <img src="{{ asset($player->mostPlayedChampion()->photo) }}" alt="{{ $player->mostPlayedChampion()->name }}" class="champion-photo">
                                                <div class="champion-name"><h1 class="titular">{{ $player->mostPlayedChampion()->name }}</h1></div>
                                            </div>
                                        @else
                                            <h5 class="subtitular">This player has not played any matches yet.</h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- ... Tus elementos para la sección derecha ... --}}
                                    <h2 class="titular subrayado">Win Rate</h2>
                                    <div class="owl-carousel owl-theme">
                                        @foreach (collect($playerChampionData)->chunk(10) as $chunk)
                                            <div class="item">
                                                @foreach ($chunk as $championId => $champion)
                                                    <div class="champion titular">
                                                        <img src="{{ asset($champion['image']) }}"
                                                            alt="{{ $champion['name'] }}" class="champion-win-rate">
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
                                <div class="row" style="margin-top: 40px">
                                    <div class="col-md-12" style="margin-bottom: 50px">
                                        <div style="height: 5px; background-color: #e44445;"></div>
                                        <h1 class="titular subrayado">Fans</h1>

                                        @php
                                            $fans = \App\Models\User::where('favorite_team', $team->id)->get();
                                            $user = Auth::user();
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
                                            <div style="margin-bottom: 20px;">
                                                Para hacerse fan, por favor <button onclick="location.href='/login'" class="btn btn-boton6">Login</button>
                                            </div>
                                        @endif

                                        @if ($fans->isEmpty())
                                            <h5>This team doesn't have any fans yet.</h5>
                                        @else
                                            <x-fans-section :fans="$fans" />
                                        @endif
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.change_favorite')
@endsection
