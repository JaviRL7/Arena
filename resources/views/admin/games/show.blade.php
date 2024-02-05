@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var resultToggle = document.getElementById('resultToggle');
        var teamBlueResult = document.getElementById('team_blue_result');
        var teamRedResult = document.getElementById('team_red_result');

        // Inicializar el estado del toggle de manera inversa
        if (teamBlueResult.value === 'W') {
            resultToggle.checked = false;
        } else {
            resultToggle.checked = true;
        }

        resultToggle.addEventListener('change', function () {
            if (this.checked) {
                teamBlueResult.value = 'L';
                teamRedResult.value = 'W';
            } else {
                teamBlueResult.value = 'W';
                teamRedResult.value = 'L';
            }
        });
    });
</script>



    <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h1 class="titulos">Winner of the game</h1>
        <hr class="custom-hr2">
        <div class="custom-div">
            <div class="titular">
                <label for="team_blue_id" class="titular">Blue side team:</label>
                <select name="team_blue_id" id="team_blue_id">
                    @php
                        $team1 = $game->serie->team_1;
                        $team2 = $game->serie->team_2;
                    @endphp
                    <option value="{{ $team1->id }}" {{ $team1->id == $game->team_blue_id ? 'selected' : '' }}>
                        {{ $team1->name }}
                    </option>
                    <option value="{{ $team2->id }}" {{ $team2->id == $game->team_blue_id ? 'selected' : '' }}>
                        {{ $team2->name }}
                    </option>
                </select>
            </div>
            <div class="selector titular">

                <div class="switch">
                    <label >
                        <input type="checkbox" id="resultToggle">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="titular">
                <label for="team_red_id" class="titular">red side team:</label>
                <select name="team_red_id" id="team_red_id">
                    @php
                        $team1 = $game->serie->team_1;
                        $team2 = $game->serie->team_2;
                    @endphp
                    <option value="{{ $team1->id }}" {{ $team1->id == $game->team_red_id ? 'selected' : '' }}>
                        {{ $team1->name }}
                    </option>
                    <option value="{{ $team2->id }}" {{ $team2->id == $game->team_red_id ? 'selected' : '' }}>
                        {{ $team2->name }}
                    </option>
                </select>
            </div>
            <div class="titular">
                <label for="number" class="titular">Map number:</label>
                <input type="number" id="number" name="number" value="{{ $game->number }}">
            </div>

            <input type="hidden" id="team_blue_result" name="team_blue_result" value="{{ $game->team_blue_result }}">
            <input type="hidden" id="team_red_result" name="team_red_result" value="{{ $game->team_red_result }}">

        </div>
        <h1 class="titulos">Ban phase</h1>
        <hr class="custom-hr2">

        <div class="ban_phase_container titular">
            <div class="ban_phase_blue">
                @for ($i = 1; $i <= 5; $i++)
                    <div>
                        <label for="ban{{ $i }}_blue">Ban {{ $i }} Blue side:</label>
                        <select name="ban{{ $i }}_blue" id="ban{{ $i }}_blue">
                            <option value="">No champ selected</option>

                            @foreach ($champions as $champion)
                                <option value="{{ $champion->id }}"
                                    {{ $champion->id == $game->{"ban{$i}_blue"} ? 'selected' : '' }}>
                                    {{ $champion->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endfor
            </div>

            <div class="ban_phase_red">
                @for ($i = 1; $i <= 5; $i++)
                    <div>
                        <label for="ban{{ $i }}_red">Ban {{ $i }} Red side:</label>
                        <select name="ban{{ $i }}_red" id="ban{{ $i }}_red">
                            <option value="">No champ selected</option>
                            @foreach ($champions as $champion)
                                <option value="{{ $champion->id }}"
                                    {{ $champion->id == $game->{"ban{$i}_red"} ? 'selected' : '' }}>
                                    {{ $champion->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endfor
            </div>
        </div>


        <h1 class="titulos">Game data</h1>
        <hr class="custom-hr2">

        <div class="table-responsive" style="margin-left: 15%; margin-right: 15%;">
            <table class="table">
                <tbody>
                    @foreach ($players_blue as $player_blue)
                        <tr class="align-middle">
                            <td>
                                <img src="{{ asset($player_blue->photo) }}" alt="{{ $player_blue->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </td>
                            <td>
                                <div class="titular">{{ $player_blue->nick }}<br>
                                    <span class="comentarios">{{ $player_blue->name }}
                                        {{ $player_blue->lastname1 }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <img src="{{ asset($player_blue->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                        alt="{{ $player_blue->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                        class="w-14 h-14 object-cover rounded-full">
                                </div>
                            </td>
                            <td>
                                <label for="champion" class="subtitular">Champion:</label>
                            </td>
                            <td>
                                <select class="comentarios" name="players[{{ $player_blue->id }}][champion]" id="champion">
                                    @foreach ($champions as $champion)
                                        <option class="comentarios" value="{{ $champion->id }}"
                                            {{ $champion->id == $player_blue->games->where('id', $game->id)->first()->pivot->champion->id ? 'selected' : '' }}>
                                            {{ $champion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label class="comentarios" for="kills">Kills:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="kills" name="players[{{ $player_blue->id }}][kills]"
                                    value="{{ $player_blue->games->where('id', $game->id)->first()->pivot->kills }}">
                            </td>
                            <td>
                                <label class="comentarios" for="assists">Assists:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="assists" name="players[{{ $player_blue->id }}][assists]"
                                    value="{{ $player_blue->games->where('id', $game->id)->first()->pivot->deaths }}">
                            </td>
                            <td>
                                <label class="comentarios"  for="deaths">Deaths:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="deaths" name="players[{{ $player_blue->id }}][deaths]"
                                    value="{{ $player_blue->games->where('id', $game->id)->first()->pivot->assists }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <br>
        <br>
        <div class="table-responsive" style="margin-left: 15%; margin-right: 15%;">
            <table class="table">
                <tbody>
                    @foreach ($players_red as $player_red)
                        <tr class="align-middle">
                            <td>
                                <img src="{{ asset($player_red->photo) }}" alt="{{ $player_red->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </td>
                            <td>
                                <div class="titular">{{ $player_red->nick }}<br>
                                    <span class="comentarios">{{ $player_red->name }}
                                        {{ $player_red->lastname1 }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <img src="{{ asset($player_red->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                        alt="{{ $player_red->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                        class="w-14 h-14 object-cover rounded-full">
                                </div>
                            </td>
                            <td>
                                <label for="champion" class="subtitular">Champion:</label>
                            </td>
                            <td>
                                <select class="comentarios" name="players[{{ $player_red->id }}][champion]" id="champion">
                                    @foreach ($champions as $champion)
                                        <option class="comentarios" value="{{ $champion->id }}"
                                            {{ $champion->id == $player_red->games->where('id', $game->id)->first()->pivot->champion->id ? 'selected' : '' }}>
                                            {{ $champion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label class="comentarios" for="kills">Kills:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="kills" name="players[{{ $player_red->id }}][kills]"
                                    value="{{ $player_red->games->where('id', $game->id)->first()->pivot->kills }}">
                            </td>
                            <td>
                                <label class="comentarios" for="assists">Assists:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="assists" name="players[{{ $player_red->id }}][assists]"
                                    value="{{ $player_red->games->where('id', $game->id)->first()->pivot->deaths }}">
                            </td>
                            <td>
                                <label class="comentarios"  for="deaths">Deaths:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="deaths" name="players[{{ $player_red->id }}][deaths]"
                                    value="{{ $player_red->games->where('id', $game->id)->first()->pivot->assists }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 50px">
            <h1 class="comentarios mr-3">
                Update game data
            </h1>
            <input type="submit" value="Update" class="btn btn-boton7" style="margin: 0%; margin-left:10px">
        </div>
    </form>
    </div>
@endsection
