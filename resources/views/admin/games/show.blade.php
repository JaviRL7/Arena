@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
    <style>
        /* Estilo del interruptor de alternancia */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin: 0 auto; /* Centra el interruptor de alternancia */
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    border: 1px solid white; /* Añade un borde blanco */

}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 3px; /* Ajusta la posición de la "bolita" */
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}
input:checked + .slider {
    background-color: #e44445; /* Rojo cuando está activado */
}

input:not(:checked) + .slider {
    background-color: #2196F3; /* Azul cuando no está activado */
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Forma redondeada del interruptor (si prefieres) */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

.custom-div {
    display: flex;

    align-items: center;
    justify-content: center;
    /* El resto de tus estilos */
}

.custom-div {
    display: flex;

    align-items: center;
    gap: 40px;

}

.selector {
    align-self: center;
    margin-top: auto;
}

    </style>
    <div class="table-responsive">
        <table class="table-striped table">
            <tbody>

                <div class="custom-div">
                    <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="team_blue_id">Equipo Azul:</label>
                            <select name="team_blue_id" id="team_blue_id">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $game->team_blue_id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="selector">

                            <div class="switch">
                                <label>
                                    <input type="checkbox" id="resultToggle">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="team_red_id">Equipo Rojo:</label>
                            <select name="team_red_id" id="team_red_id">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $game->team_red_id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                        <!-- Selector de resultados -->

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var resultToggle = document.getElementById('resultToggle');
                                var blueResult = document.getElementById('team_blue_result');
                                var redResult = document.getElementById('team_red_result');

                                resultToggle.addEventListener('change', function() {
                                    if (this.checked) {
                                        blueResult.value = 'W';
                                        redResult.value = 'L';
                                    } else {
                                        blueResult.value = 'L';
                                        redResult.value = 'W';
                                    }
                                });

                                // Inicialización basada en los valores actuales
                                resultToggle.checked = blueResult.value === 'W';
                            });
                        </script>

                        @foreach ($players_blue as $player_blue)
                            <tr class="align-middle">
                                <th>
                                    <img src="{{ asset($player_blue->photo) }}" alt="{{ $player_blue->photo }}"
                                        class="w-36 h-36 object-cover rounded-full">
                                </th>
                                <th>
                                    <div class="">{{ $player_blue->nick }}<br>
                                        <span class="text-gray-500">{{ $player_blue->name }}
                                            {{ $player_blue->lastname1 }}
                                        </span>
                                    </div>
                                </th>
                                <th>
                                    <div class="">
                                        <img src="{{ asset($player_blue->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                            alt="{{ $player_blue->games->first()->pivot->champion->name }}"
                                            class="w-14 h-14 object-cover rounded-full">
                                    </div>
                                </th>
                                <th>
                                    <div class="">
                                        <p>{{ $player_blue->games->first()->pivot->champion->name }}</p>
                                    </div>
                                </th>
                                <th>


                                    <label for="champion">Champion:</label>
                                    <select name="players[{{ $player_blue->id }}][champion]" id="champion">
                                        @foreach ($champions as $champion)
                                            <option value="{{ $champion->id }}"
                                                {{ $champion->id == $player_blue->games->first()->pivot->champion->id ? 'selected' : '' }}>
                                                {{ $champion->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label for="kills">Kills:</label>
                                    <input type="number" id="kills" name="players[{{ $player_blue->id }}][kills]"
                                        value="{{ $player_blue->games->where('id', $game->id)->first()->pivot->kills }}">

                                    <label for="assists">Assists:</label>
                                    <input type="number" id="assists" name="players[{{ $player_blue->id }}][assists]"
                                        value="{{ $player_blue->games->where('id', $game->id)->first()->pivot->deaths }}">

                                    <label for="deaths">Deaths:</label>
                                    <input type="number" id="deaths" name="players[{{ $player_blue->id }}][deaths]"
                                        value="{{ $player_blue->games->where('id', $game->id)->first()->pivot->assists }}">


                                </th>
                            </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table-striped table">
            <tbody>
                @foreach ($players_red as $player_red)
                    <tr class="align-middle">
                        <th>
                            <img src="{{ asset($player_red->photo) }}" alt="{{ $player_red->photo }}"
                                class="w-36 h-36 object-cover rounded-full">
                        </th>
                        <th>
                            <div class="">{{ $player_red->nick }}<br>
                                <span class="text-gray-500">{{ $player_red->name }}
                                    {{ $player_red->lastname1 }}
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="">
                                <img src="{{ asset($player_red->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $player_red->games->first()->pivot->champion->name }}"
                                    class="w-14 h-14 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="">
                                <p>{{ $player_red->games->first()->pivot->champion->name }}</p>
                            </div>
                        </th>
                        <th>


                            <label for="champion">Champion:</label>
                            <select name="players[{{ $player_red->id }}][champion]" id="champion">
                                @foreach ($champions as $champion)
                                    <option value="{{ $champion->id }}"
                                        {{ $champion->id == $player_red->games->first()->pivot->champion->id ? 'selected' : '' }}>
                                        {{ $champion->name }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="kills">Kills:</label>
                            <input type="number" id="kills" name="players[{{ $player_red->id }}][kills]"
                                value="{{ $player_red->games->where('id', $game->id)->first()->pivot->kills }}">

                            <label for="assists">Assists:</label>
                            <input type="number" id="assists" name="players[{{ $player_red->id }}][assists]"
                                value="{{ $player_red->games->where('id', $game->id)->first()->pivot->deaths }}">

                            <label for="deaths">Deaths:</label>
                            <input type="number" id="deaths" name="players[{{ $player_red->id }}][deaths]"
                                value="{{ $player_red->games->where('id', $game->id)->first()->pivot->assists }}">



                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="submit" value="Actualizar">
        </form>
    </div>
@endsection
