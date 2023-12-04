@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
    <div class="table-responsive">
        <table class="table-striped table">
            <tbody>

                <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Selector de equipos -->
                    <label for="team_blue_id">Equipo Azul:</label>
                    <select name="team_blue_id" id="team_blue_id">
                        @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            {{ $team->id == $game->team_blue_id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                        @endforeach
                    </select>

                    <label for="team_red_id">Equipo Rojo:</label>
                    <select name="team_red_id" id="team_red_id">
                        @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            {{ $team->id == $game->team_red_id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                        @endforeach
                    </select>

                    <!-- Selector de resultados -->
                    <label for="team_blue_result">Resultado del Equipo Azul:</label>
                    <select name="team_blue_result" id="team_blue_result">
                        <option value="W" {{ $game->team_blue_result == 'W' ? 'selected' : '' }}>W</option>
                        <option value="L" {{ $game->team_blue_result == 'L' ? 'selected' : '' }}>L</option>
                    </select>

                    <label for="team_red_result">Resultado del Equipo Rojo:</label>
                    <select name="team_red_result" id="team_red_result">
                        <option value="W" {{ $game->team_red_result == 'W' ? 'selected' : '' }}>W</option>
                        <option value="L" {{ $game->team_red_result == 'L' ? 'selected' : '' }}>L</option>
                    </select>



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
