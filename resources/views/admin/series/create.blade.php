@extends('layouts.plantilla')

@section('title', 'Create a new series')

@section('content')
    <div class="container mt-5" style="min-height: 80vh" x-data="seriesPreview()">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 shadow-sm">
                    <div class="mb-4">
                        <h1 class="titular subrayado">Create a new series</h1>
                        <!-- Previsualización -->
                        <div id="preview" class="d-flex align-items-center justify-content-around mb-4">
                            <template x-if="team1.logo">
                                <img x-bind:src="team1.logo" alt="Team 1 Logo" class="team-logo mr-2">
                            </template>
                            <p x-text="team1.name" class="titular mr-2"></p>
                            <p class="titular mr-2">vs</p>
                            <p x-text="team2.name" class="titular mr-2"></p>
                            <template x-if="team2.logo">
                                <img x-bind:src="team2.logo" alt="Team 2 Logo" class="team-logo mr-2">
                            </template>
                            <div class="d-flex flex-column align-items-start ml-2">
                                <p x-text="competition.name" class="titular mr-2"></p>
                                <p x-text="type" class="titular mr-2"></p>
                                <p x-text="name" class="titular mr-2"></p>
                                <p x-text="date" class="titular"></p>
                            </div>
                            <template x-if="competition.logo">
                                <img x-bind:src="competition.logo" alt="Competition Logo" class="competition-logo mr-2">
                            </template>
                            <template x-if="error">
                                <p class="error titular" style="color: red" x-text="error"></p>
                            </template>
                        </div>
                        <hr class="custom-hr">
                        <!-- Formulario -->
                        <form action="{{ route('admin.series.store') }}" method="POST" enctype="multipart/form-data"
                            class="mt-4" x-on:submit="return validateMatch()">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6 pr-md-2">
                                    <div class="form-group mb-3">
                                        <label for="competition" class="form-label titular">Competition</label>
                                        <select id="competition" name="competition_id" class="form-control rounded-lg"
                                            x-on:change="updateCompetition($event)">
                                            <option value="">No competition selected</option>
                                            @foreach ($competitions as $competition)
                                                <option value="{{ $competition->id }}"
                                                    data-logo="{{ asset($competition->logo) }}"
                                                    data-region="{{ $competition->region }}">{{ $competition->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="team1" class="form-label titular">Team 1</label>
                                        <select id="team1" name="team1" class="form-control rounded-lg"
                                            x-on:change="updateTeam1($event)">
                                            <option value="">No team selected</option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->id }}" data-logo="{{ asset($team->logo) }}"
                                                    data-league-id="{{ $team->league_id }}">
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="team2" class="form-label titular">Team 2</label>
                                        <select id="team2" name="team2" class="form-control rounded-lg"
                                            x-on:change="updateTeam2($event)">
                                            <option value="">No team selected</option>
                                            @foreach ($teams as $team)
                                                <option value="{{ $team->id }}" data-logo="{{ asset($team->logo) }}"
                                                    data-league-id="{{ $team->league_id }}">
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6 pl-md-2">
                                    <div class="form-group mb-3">
                                        <label for="type" class="form-label titular">Type</label>
                                        <select id="type" name="type" class="form-control rounded-lg"
                                            x-on:change="updateType($event)">
                                            <option value="bo1">BO1</option>
                                            <option value="bo3">BO3</option>
                                            <option value="bo5">BO5</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label titular">Name</label>
                                        <select id="name" name="name" class="form-control rounded-lg"
                                            x-on:change="updateName($event)">
                                            <option value="Finale">Finale</option>
                                            <option value="Semi-finals">Semi-finals</option>
                                            <option value="Quarterfinals">Quarterfinals</option>
                                            <option value="Regular split">Regular split</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="date" class="form-label titular">Date</label>
                                        <input type="date" id="date" name="date"
                                            class="form-control rounded-lg" x-on:change="updateDate($event)">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-boton7" :disabled="error !== ''">Create Series</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        function seriesPreview() {
            return {
                team1: {
                    id: '',
                    name: '',
                    logo: '',
                    league_id: ''
                },
                team2: {
                    id: '',
                    name: '',
                    logo: '',
                    league_id: ''
                },
                competition: {
                    id: '',
                    name: '',
                    logo: '',
                    region: ''
                },
                type: '',
                name: '',
                date: '',
                error: '',
                validateMatch() {
                    if (this.team1.id === this.team2.id) {
                        this.error = 'The same team cannot play against itself.';
                        return false;
                    }

                    if (this.competition.name !== 'Worlds' && this.competition.name !== 'MSI') {
                        if (this.team1.league_id !== this.team2.league_id) {
                            this.error = 'Teams must be from the same league unless the competition is Worlds or MSI.';
                            return false;
                        }
                    }

                    this.error = '';
                    return true;
                },
                updateTeam1(event) {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    this.team1.id = selectedOption.value;
                    this.team1.name = selectedOption.text;
                    this.team1.logo = selectedOption.dataset.logo || '';
                    this.team1.league_id = selectedOption.dataset.leagueId || '';
                    this.validateMatch();
                },
                updateTeam2(event) {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    this.team2.id = selectedOption.value;
                    this.team2.name = selectedOption.text;
                    this.team2.logo = selectedOption.dataset.logo || '';
                    this.team2.league_id = selectedOption.dataset.leagueId || '';
                    this.validateMatch();
                },
                updateCompetition(event) {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    this.competition.id = selectedOption.value;
                    this.competition.name = selectedOption.text;
                    this.competition.logo = selectedOption.dataset.logo || '';
                    this.competition.region = selectedOption.dataset.region || '';
                    this.validateMatch();
                },
                updateDate(event) {
                    this.date = event.target.value;
                },
                updateType(event) {
                    this.type = event.target.value;
                },
                updateName(event) {
                    this.name = event.target.value;
                },
            }
        }
    </script>
@endsection
