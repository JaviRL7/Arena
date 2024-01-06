@extends('layouts.plantilla')

@section('title', 'Player Profile')

@section('content')
<div class="container player-profile-container">
    <div class="row">
        <div class="col-md-12 player-profile-main">
            <img src="{{ asset($player->img) }}" alt="" class="player-profile-img">

            <div class="player-profile-photo">
                <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-profile-photo-img">
            </div>

            <div class="player-profile-information">
                <h1 class="player-profile-nick">{{ $player->nick }}</h1>
                <h2 class="player-profile-name">{{ $player->name }}</h2>
                <h2 class="player-profile-lastname">{{ $player->lastname1 }}</h2>
            </div>

            <div class="player-profile-current-team">
                <h1>Current Team</h1>
                @if ($player->currentTeam())
                    <img src="{{ asset($player->currentTeam()->logo) }}" alt="{{ $player->currentTeam()->name }}">
                    <h2>{{ $player->currentTeam()->name }}</h2>
                @else
                    <h2>Free-agent</h2>
                @endif
            </div>


            <div class="player-profile-team-history">
                <h1>Team History</h1>
                @foreach ($player->teams as $team)
                    <div class="player-profile-team">
                        <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}">
                        <h2>{{ $team->name }}</h2>
                    </div>
                @endforeach
            </div>

            <div class="player-profile-stats">
                <h1>Player Stats</h1>
                <h2>KDA: {{ $player->getKDA() }}</h2>
                <h2>Total Kills: {{ $player->getTotalKills() }}</h2>
                <h2>Total Assists: {{ $player->getTotalAssists() }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
