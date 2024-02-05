@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var resultToggle = document.getElementById('resultToggle');
        var teamBlueId = document.getElementById('team_blue_id');
        var teamRedId = document.getElementById('team_red_id');
        var teamBlueName = document.getElementById('team_blue_name');
        var teamRedName = document.getElementById('team_red_name');
        var switchSideBtn = document.getElementById('switchSideBtn');

        resultToggle.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('team_blue_result').value = 'L';
                document.getElementById('team_red_result').value = 'W';
            } else {
                document.getElementById('team_blue_result').value = 'W';
                document.getElementById('team_red_result').value = 'L';
            }
        });

        switchSideBtn.addEventListener('click', function(e) {
            e.preventDefault();

            // Intercambiar los valores de los equipos
            var tempId = teamBlueId.value;
            var tempName = teamBlueName.textContent;
            teamBlueId.value = teamRedId.value;
            teamBlueName.textContent = teamRedName.textContent;
            teamRedId.value = tempId;
            teamRedName.textContent = tempName;
        });
    });
</script>


    <form id="createGameForm" action="{{ route('admin.games.create_game') }}" method="POST">
        @csrf
        <h1 class="titulos">Winner of the game</h1>
        <hr class="custom-hr2">
        <div class="container-fluid" style="margin: 0 auto; max-width: 60%;">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="row align-items-center mb-3">
                @php
                    $team1 = $serie->team_1;
                    $team2 = $serie->team_2;
                @endphp
                <!-- Blue side team -->
                <div class="col-5 text-center">
                    <span class="subtitular">Blue side team:</span>
                    <div id="team_blue_name" class="titular">{{ $team1->name }}</div>
                </div>

                <!-- Button to switch side -->
                <div class="col-2 text-center">
                    <button id="switchSideBtn" class="btn btn-secondary">Switch Side</button>
                </div>

                <!-- Red side team -->
                <div class="col-5 text-center">
                    <span class="subtitular">Red side team:</span>
                    <div id="team_red_name" class="titular">{{ $team2->name }}</div>
                </div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col-12 text-center">
                    <label for="number" class="subtitular">Map number:</label>
                    <select id="number" name="number" class="form-control d-inline-block w-5" style="width: 60px">
                        @foreach ($availableNumbers as $num)
                            <option value="{{ $num }}" {{ old('number') == $num ? 'selected' : '' }}>{{ $num }}</option>
                        @endforeach
                    </select>
                    <div id="numberError" class="text-danger"></div>
                </div>
            </div>
            <input type="hidden" id="team_blue_id" name="team_blue_id" value="{{ $team1->id }}">
            <input type="hidden" id="team_red_id" name="team_red_id" value="{{ $team2->id }}">
            <hr class="custom-hr2">

            <!-- Row for the game result selector -->
            <div class="row align-items-center mb-3">
                <div class="col-12 text-center">
                    <span class="subtitular">Game Result:</span>
                    <div class="switch d-inline-block ms-2">
                        <label>
                            <input type="checkbox" id="resultToggle">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
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
                                <option value="{{ $champion->id }}">
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
                                <option value="{{ $champion->id }}">
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

        <!-- Game data for blue team -->
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
                                <label for="champion" class="subtitular">Champion:</label>
                            </td>
                            <td>
                                <select class="comentarios" name="players[{{ $player_blue->id }}][champion]"
                                    id="champion">
                                    @foreach ($champions as $champion)
                                        <option class="comentarios" value="{{ $champion->id }}">
                                            {{ $champion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label class="comentarios" for="kills">Kills:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="kills"
                                    name="players[{{ $player_blue->id }}][kills]"
                                    value="{{ old('players.' . $player_blue->id . '.kills') }}">
                            </td>
                            <td>
                                <label class="comentarios" for="assists">Assists:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="assists"
                                    name="players[{{ $player_blue->id }}][assists]"
                                    value="{{ old('players.' . $player_blue->id . '.assists') }}">
                            </td>
                            <td>
                                <label class="comentarios" for="deaths">Deaths:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="deaths"
                                    name="players[{{ $player_blue->id }}][deaths]"
                                    value="{{ old('players.' . $player_blue->id . '.deaths') }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Game data for red team -->
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
                                <label for="champion" class="subtitular">Champion:</label>
                            </td>
                            <td>
                                <select class="comentarios" name="players[{{ $player_red->id }}][champion]"
                                    id="champion">
                                    @foreach ($champions as $champion)
                                        <option class="comentarios" value="{{ $champion->id }}" data-image-url="{{ $champion->square }}">
                                            {{ $champion->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label class="comentarios" for="kills">Kills:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="kills"
                                    name="players[{{ $player_red->id }}][kills]"
                                    value="{{ old('players.' . $player_red->id . '.kills') }}">
                            </td>
                            <td>
                                <label class="comentarios" for="assists">Assists:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="assists"
                                    name="players[{{ $player_red->id }}][assists]"
                                    value="{{ old('players.' . $player_red->id . '.assists') }}">
                            </td>
                            <td>
                                <label class="comentarios" for="deaths">Deaths:</label>
                            </td>
                            <td>
                                <input class="comentarios" type="number" id="deaths"
                                    name="players[{{ $player_red->id }}][deaths]"
                                    value="{{ old('players.' . $player_red->id . '.deaths') }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <br>
        <br>
        <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 50px">
            <input type="submit" value="Create Game" class="btn btn-primary">
            <input type="hidden" name="serie_id" value="{{ $serie->id }}">
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('createGameForm');
            var teamBlueId = document.getElementById('team_blue_id');
            var teamRedId = document.getElementById('team_red_id');
            var number = document.getElementById('number');
            var numberError = document.getElementById('numberError');
            // Repite para cada campo requerido

            form.addEventListener('submit', function(event) {
                var isValid = true;

                // Validar número de mapa
                if (!number.value.trim()) {
                    numberError.textContent = 'Map number is required.';
                    isValid = false;
                } else {
                    numberError.textContent = '';
                }

                // Repite la validación para cada campo requerido

                if (!isValid) {
                    event.preventDefault(); // Detener el envío del formulario
                }
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var championSelector = document.getElementById('champion');
        var championImage = document.querySelector('.champion-image');

        championSelector.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var imageUrl = selectedOption.getAttribute('data-image-url');
            championImage.src = imageUrl;
        });
    });
    </script>
@endsection
