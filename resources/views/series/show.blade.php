@extends('layouts.plantilla')
@section('title', 'Series show')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="serie-info">
                <h1 id="titulo1" class="titulo">

                </h1>
                <h3 id="titulo2" class="titulo">

                </h3>
            </div>
            <div class="team-images">
                <img src="{{ asset($serie->team_1->team_photo) }}" class="img-fluid team-img">
                <img src="{{ asset('recursos/VS.png') }}" class="img-fluid vs-img">
                <img src="{{ asset($serie->team_2->team_photo) }}" class="img-fluid team-img">
            </div>
            <div class="serie-show-result">
                <img src="{{ asset($serie->competition->logo) }}" alt="{{ $serie->team_1->name }}" class="img-fluid">

                <div class="vertical-separator"></div>

                <div class="titles">
                    <h5 class="titular">{{ $serie->competition->name }}</h5>
                    <h5 class="titular">{{ $serie->type }}</h5>
                    <h5 class="titular">{{ $serie->name }}</h5>
                    <h5 class="titular">{{ $serie->date }}</h5>
                </div>
                <div class="space"></div>
                <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_1->name }}"
                    class="img-fluid img-fluid-logos wide-logo">

                <div class="result">
                    <h2 class="titular">{{ $serie->getResultSerie() }}</h2>
                </div>

                <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}"
                    class="img-fluid img-fluid-logos wide-logo">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            @foreach ($serie->games as $game)
                @php
                    $date = $serie->date;
                    $players_blue = $serie->team_1->getPlayersDate($date);
                    $players_red = $serie->team_2->getPlayersDate($date);

                @endphp
                @foreach ($players_blue as $player_blue)
                    @include('modals.vote')
                @endforeach
                @foreach ($players_red as $player_red)
                    @include('modals.vote2')
                @endforeach
            @endforeach
            @if ($serie->games->count() > 0)
                <h1 class="titulo titulo-serie">Game Data</h1>

                <div class="owl-carousel owl-theme owl-grande">

                    @foreach ($serie->games as $game)
                        @php
                            $team_blue = $game->team_blue;
                            $team_red = $game->team_red;
                            $date = $serie->date;
                            $players_blue = $game->team_blue->getPlayersDate($date);
                            $players_red = $game->team_red->getPlayersDate($date);
                        @endphp

                        <div class="item">
                            <div class="tabla-contenedor tabla-margin">
                                <table class="tabla-responsive">
                                    <tbody>
                                        @for ($i = 0; $i < max(count($players_blue), count($players_red)); $i++)
                                            <x-player-matchup-display :player-blue="$players_blue[$i] ?? null" :player-red="$players_red[$i] ?? null"
                                                :game="$game" />
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <x-ban-phase-display :game="$game" />
                        </div>
                    @endforeach
                </div>

            @endif

            @php
                $now = \Carbon\Carbon::now();
            @endphp

@if ($serie->date <= $now || !auth()->check())
@include('includes.votaciones', ['static' => true])
@else
@include('includes.votaciones', ['static' => false])
@endif

        </div>
        @include('includes.community-feedback', ['activities' => $activities])
    </div>

    <div class="row">
        <x-comment-form :serie="$serie" />
        <x-comment-display :comments="$serie->comments" />
    </div>
</div>
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/serie/show.js') }}"></script>

@endsection

@endsection
