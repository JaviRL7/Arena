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

@if ($serie->date > $now && auth()->check())
    <div class="prediction-form">
        <form action="{{ route('predictions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="serie_id" value="{{ $serie->id }}">

            <!-- Botones para votar -->
            <button type="submit" name="team_1_win" value="1" class="vote-button">Win
                {{ $serie->team_1->name }}</button>
            <button type="submit" name="team_1_win" value="0" class="vote-button">Win
                {{ $serie->team_2->name }}</button>
        </form>
    </div>

    <div class="progress-bar-container">
        <img src="{{ asset($serie->team_1->logo) }}" class="team-logo">
        <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <img src="{{ asset($serie->team_2->logo) }}" class="team-logo">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            document.querySelectorAll('.vote-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = button.closest('form');
                    const formData = new FormData(form);
                    formData.set(button.name, button.value); // Set the correct value for team_1_win

                    fetch('{{ route('predictions.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken, // Use the CSRF token obtained earlier
                            'Accept': 'application/json', // Expect a JSON response
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data); // Muestra la respuesta en la consola
                        // Update the progress bars based on the response
                        const progressBarTeam1 = document.querySelector('.progress-bar.bg-primary');
                        const progressBarTeam2 = document.querySelector('.progress-bar.bg-danger');
                        if (progressBarTeam1 && progressBarTeam2) {
                            progressBarTeam1.style.width = `${data.percentageTeam1}%`;
                            progressBarTeam1.setAttribute('aria-valuenow', data.percentageTeam1);
                            progressBarTeam2.style.width = `${100 - data.percentageTeam1}%`;
                            progressBarTeam2.setAttribute('aria-valuenow', 100 - data.percentageTeam1);
                        } else {
                            console.error('Progress bars not found');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script>
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
