@extends('layouts.plantilla')
@section('title', 'Teams admin edit')
@section('content')

    <div class="container" style="min-height: 80vh; margin-top:100px">


        <div x-data="{
            name: '{{ $team->name }}',
            logo: '{{ $team->logo }}',
            competition_id: '{{ $team->competition_id }}',
            competition_name: '{{ $team->competition->name }}',
            country: '{{ $team->country }}',
            logoData: '{{ $team->logo ? asset($team->logo) : '' }}',
            logoPreview() {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.logoData = e.target.result;
                };
                reader.readAsDataURL(this.$refs.logo.files[0]);
            },
            updateCompetitionName() {
                const selectedCompetition = this.$refs.competitionSelect.options[this.$refs.competitionSelect.selectedIndex];
                this.competition_name = selectedCompetition.text;
            }
        }">
            <div class="team-alpine">
                <div class="team-container">
                    <div class="logo-team-container">
                        <img x-show="logoData" :src="logoData">
                    </div>
                    <div class="name-team-container">
                        <h1><span x-text="name"></span></h1>
                        <h3><span x-text="competition_name"></span></h3>
                        <h3><span x-text="country"></span></h3>
                    </div>
                </div>
                <div class="players-container">
                    <h3>Current Players:</h3>
                    @foreach ($team->getPlayersDate(\Carbon\Carbon::now()) as $player)
                        <p>{{ $player->role->name }} : {{ $player->nick }}</p>
                    @endforeach
                </div>
            </div>
            <br>
            <br>


            <div class="contenedor-formulario-team">
                <div class="form-group-left">
                    <div class="form-group">
                        <label for="name">Team Name</label>
                        <input type="text" class="form-control border-danger w-50" id="name" name="name"
                            x-model="name" value="{{ $team->name }}">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control border-danger w-50" id="country" name="country"
                            x-model="country" value="{{ $team->country ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="competition_id">Competition</label>
                        <select class="form-control border-danger w-50" id="competition_id" name="competition_id"
                            x-ref="competitionSelect" @change="updateCompetitionName()">
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}"
                                    {{ $competition->id == $team->competition_id ? 'selected' : '' }}>
                                    {{ $competition->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group-right">
                    <div class="form-group">
                        <label for="logo">Team Logo</label>
                        <input type="file" class="form-control-file border-danger w-50" id="logo" name="logo"
                            x-ref="logo" @change="logoPreview()">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success">Enviar</button>

            </div>
            <div class="add-player-button-container">
                <h2>Do you want to add a new player to this team ?</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addPlayerModal{{ $team->id }}">
                    Add Player
                </button>
            </div>
            @include('modals.add_player')
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin: 10px">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="titulo">Current players</h1>
            </div>
            <div class="current-players-container">
                @foreach ($team->getPlayersDate(\Carbon\Carbon::now())->where('pivot.substitute', false) as $player)
                    <div class="player-card">
                        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-photo">
                        <div class="player-info">
                            <h2 class="player-nick">{{ $player->nick }}</h2>
                            <p class="player-role">Role: {{ $player->role->name }}</p>
                            <p class="player-date">Start Date: {{ $player->pivot->start_date }}</p>
                            <p class="player-date">End Date: {{ $player->pivot->contract_expiration_date }}</p>
                        </div>
                        <div class="player-buttons">
                            <button type="button" class="boton1" data-bs-toggle="modal"
                                data-bs-target="#renewModal{{ $player->id }}">Extend contract</button>
                            <button type="button" class="boton2" data-bs-toggle="modal"
                                data-bs-target="#setEndDateModal{{ $player->id }}">Terminate contract</button>
                            <button type="button" class="boton3" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $player->id }}">Edit contract</button>
                            <button type="button" class="boton4" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $player->id }}">Delete vinculation</button>
                        </div>

                        <!-- Modales -->
                        @include('modals.renew')
                        @include('modals.terminate_player')
                        @include('modals.modificate_player')
                        @include('modals.eliminate')

                    </div>
                @endforeach
            </div>
            <div>
                <h1 class="titulo">Current substitute players</h1>
            </div>
            <div class="current-players-container">
                @foreach ($team->getPlayersSubstitute() as $player)
                    <div class="player-card">
                        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-photo">
                        <div class="player-info">
                            <h2 class="player-nick">{{ $player->nick }}</h2>
                            <p class="player-role">Role: {{ $player->role->name }}</p>
                            <p class="player-date">Start Date: {{ $player->pivot->start_date }}</p>
                            <p class="player-date">End Date: {{ $player->pivot->contract_expiration_date }}</p>
                        </div>
                        <div class="player-buttons">
                            <button type="button" class="boton1" data-bs-toggle="modal"
                                data-bs-target="#renewModal{{ $player->id }}">Extend contract</button>
                            <button type="button" class="boton2" data-bs-toggle="modal"
                                data-bs-target="#setEndDateModal{{ $player->id }}">Terminate contract</button>
                            <button type="button" class="boton3" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $player->id }}">Edit contract</button>
                            <button type="button" class="boton4" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $player->id }}">Delete vinculation</button>
                        </div>

                        <!-- Modales -->
                        @include('modals.renew')
                        @include('modals.terminate_player')
                        @include('modals.modificate_player')
                        @include('modals.eliminate')

                    </div>
                @endforeach
            </div>
            <div>
                <h1 class="titulo">Player History</h1>
            </div>
            <div class="past-players-container">
                @foreach ($team->getPastPlayers() as $player)
                    <div class="player-card">
                        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-photo">
                        <div class="player-info">
                            <h2 class="player-nick">{{ $player->nick }}</h2>
                            <p class="player-role">Role: {{ $player->role->name }}</p>
                            <p class="player-date">Start Date: {{ $player->pivot->start_date }}</p>
                            <p class="player-date">End Date: {{ $player->pivot->end_date }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            </form>
        </div>

        </form>
    </div>

@endsection
