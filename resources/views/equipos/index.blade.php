@extends('layouts.plantilla')

@section('title', 'Teams index')

@section('content')
    <div class="competitions-container">
        <div id="teams-show-competition-buttons" class="d-flex flex-wrap justify-content-center mb-3">
            @foreach ($competitions as $competition)
                @if ($competition->id != 2)
                    <!-- Excluye el botón con el ID 2 -->
                    <button value="{{ $competition->id }}" class="btn m-2 teams-show-competition-button">
                        <img src="{{ asset($competition->logo) }}" alt="{{ $competition->name }}"
                            class="teams-show-competition-logo">
                    </button>
                @endif
            @endforeach
        </div>
    </div>

    <div class="team-show-container teams-show-div" style="min-height: 70vh;">
        <div class="team-show-row">
            @foreach ($teams as $team)
                <div class="team-show-item" data-league="{{ $team->league_id }}" style="display: none;">
                    <div class="teams-show-team-card">
                        <a href="{{ route('team.profile', ['id' => $team->id]) }}">
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}" class="teams-show-team-logo">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        var buttons = document.querySelectorAll('.teams-show-competition-button');
        var teams = document.getElementsByClassName('team-show-item');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var selectedLeague = this.value;

                for (var i = 0; i < teams.length; i++) {
                    var team = teams[i];
                    var teamLeague = team.getAttribute('data-league');

                    if (selectedLeague == 6) { // Si el ID de la competición es 6, muestra todos los equipos
                        team.style.display = 'block';
                    } else if (teamLeague === selectedLeague) {
                        team.style.display = 'block';
                    } else {
                        team.style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection
