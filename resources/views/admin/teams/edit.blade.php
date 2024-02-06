@extends('layouts.plantilla')

@section('title', 'Teams admin edit')

@section('content')
    <div class="container mt-5" style="min-height: 80vh">
        <div x-data="teamData()" class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 shadow-sm">
                    <div class="mb-4">
                        <h1 class="titular subrayado">Edit Team: <span x-text="name"></span></h1>
                        <!-- Imagen de cabecera (team photo) -->
                        <div class="player-header mb-4"
                            style="background-image: url('{{ asset('default-background.jpg') }}');" x-show="team_photoData">
                            <img :src="team_photoData" alt="Player Background" class="img-fluid w-100"
                                style="height: 400px; object-fit: cover;">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Logo del equipo y detalles -->
                            <div class="d-flex align-items-center">
                                <div class="team-logo mr-3" x-show="logoData" style="">
                                    <img :src="logoData" alt="Team Logo" class="img-fluid"
                                        style="height: 100%; object-fit: cover;">
                                </div>
                                <div>
                                    <h2 x-text="name" class="titular"></h2>
                                    <h5 x-text="competition_name" class="comentarios"></h5>
                                    <p x-text="country" class="comentarios"></p>
                                </div>
                            </div>
                        </div>
                        <hr class="custom-hr">
                    </div>

                    <form id="teamForm" action="{{ route('admin.teams.update', $team) }}" method="POST"
                        enctype="multipart/form-data" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6 pr-md-2">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label titular">Name</label>
                                    <input type="text" id="name" name="name" class="form-control rounded-lg"
                                        x-model="name">
                                    <span id="nameError" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="competition_id" class="form-label titular">Competition</label>
                                    <select id="competition_id" name="competition_id" class="form-control rounded-lg"
                                        x-model="competition_id" @change="updateCompetitionName" x-ref="competitionSelect">
                                        @foreach ($competitions as $competition)
                                            <option value="{{ $competition->id }}"
                                                {{ $competition->id == $team->competition_id ? 'selected' : '' }}>
                                                {{ $competition->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="competitionError" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country" class="form-label titular">Country</label>
                                    <input type="text" id="country" name="country" class="form-control rounded-lg"
                                        x-model="country">
                                    <span id="countryError" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="logo" class="form-label titular">Logo</label>
                                    <input type="file" id="logo" name="logo" accept="image/*"
                                        class="form-control rounded-lg" x-ref="logo" @change="logoPreview">
                                    <span id="logoError" class="text-danger"></span>
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-6 pl-md-2">
                                <div class="form-group mb-3">
                                    <label for="team_photo" class="form-label titular">Header photo</label>
                                    <input type="file" id="team_photo" name="team_photo" accept="image/*"
                                        class="form-control rounded-lg" x-ref="team_photo" @change="team_photoPreview">
                                    <span id="teamPhotoError" class="text-danger"></span>
                                </div>
                                <div class="">
                                    <button id="submitBtn" type="submit" class="btn btn-boton7">Update Team</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr class="custom-hr2">
                    <div class="d-flex align-items-center" style="margin-bottom: 10%">
                        <h6 class="titular mb-0">Do you want to add a new player to this team?</h6>
                        <button type="button" style="margin: 0%; margin-left:10px" class="btn btn-boton7 ml-3"
                            data-bs-toggle="modal" data-bs-target="#addPlayerModal{{ $team->id }}">
                            Add Player
                        </button>
                    </div>


                    <!-- Include modals -->
                    @include('modals.add_player')

                    <!-- Display errors if any -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if($team->getPlayersDate(\Carbon\Carbon::now())->where('pivot.substitute', false)->isNotEmpty())
                    <div>
                        <h1 class="titular subrayado">Current players</h1>
                        <div class="">
                            <hr class="custom-hr2">
                            @foreach ($team->getPlayersDate(\Carbon\Carbon::now())->where('pivot.substitute', false) as $player)
                                <div class="d-flex mb-4">
                                    <!-- Información del jugador -->
                                    <div class="flex-grow-1 mr-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                                                class="player-photo rounded-circle mr-3"
                                                style="border-radius: 50%; width: 150px; height: 150px;">

                                            <div class="player-info" style="width: 500px;">
                                                <h3 class="titular">{{ $player->nick }}</h3>
                                                <p class="comentarios">Role: <span>{{ $player->role->name }}</span></p>
                                                <p class="comentarios">Start Date:
                                                    <span>{{ $player->pivot->start_date }}</span>
                                                </p>
                                                <p class="comentarios">End Date:
                                                    <span>{{ $player->pivot->contract_expiration_date }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Botones de acción -->
                                    <div class="d-flex flex-column">
                                        <button type="button" class="btn btn-boton7 btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#renewModal{{ $player->id }}">Extend contract</button>
                                        <button type="button" class="btn btn-boton8 btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#setEndDateModal{{ $player->id }}">Terminate
                                            contract</button>
                                        <button type="button" class="btn btn-boton9 btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $player->id }}">Edit contract</button>
                                        <button type="button" class="btn btn-boton10 btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $player->id }}">Delete vinculation</button>
                                    </div>
                                </div>

                                <hr class="custom-hr2">
                                @include('modals.renew', ['player' => $player])
                                @include('modals.terminate_player', ['player' => $player])
                                @include('modals.modificate_player', ['player' => $player])
                                @include('modals.eliminate', ['player' => $player])
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- Sección para jugadores suplentes -->
                    @if($team->getPlayersSubstitute()->isNotEmpty())

                    <hr class="custom-hr">
                    <div>
                        <h1 class="titular subrayado">Current Substitute Players</h1>
                    </div>
                    <div class="">
                        @foreach ($team->getPlayersSubstitute() as $player)
                            <div class="d-flex mb-4">
                                <!-- Información del jugador -->
                                <div class="flex-grow-1 mr-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                                            class="player-photo rounded-circle mr-3"
                                            style="border-radius: 50%; width: 150px; height: 150px;">

                                        <div class="player-info" style="width: 500px;">
                                            <h3 class="titular">{{ $player->nick }}</h3>
                                            <p class="comentarios">Role: <span>{{ $player->role->name }}</span></p>
                                            <p class="comentarios">Start Date:
                                                <span>{{ $player->pivot->start_date }}</span>
                                            </p>
                                            <p class="comentarios">End Date:
                                                <span>{{ $player->pivot->contract_expiration_date }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Botones de acción -->
                                <div class="d-flex flex-column">
                                    <button type="button" class="btn btn-boton7 btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#renewModal{{ $player->id }}">Extend contract</button>
                                    <button type="button" class="btn btn-boton8 btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#setEndDateModal{{ $player->id }}">Terminate
                                        contract</button>
                                    <button type="button" class="btn btn-boton9 btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $player->id }}">Edit contract</button>
                                    <button type="button" class="btn btn-boton10 btn-sm mb-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $player->id }}">Delete vinculation</button>
                                </div>
                            </div>
                            <hr class="custom-hr2">
                            @include('modals.renew', ['player' => $player])
                            @include('modals.terminate_player', ['player' => $player])
                            @include('modals.modificate_player', ['player' => $player])
                            @include('modals.eliminate', ['player' => $player])
                        @endforeach
                    </div>
                    @endif

                    <!-- Sección para historial de jugadores -->

                    @if($team->getPastPlayers()->isNotEmpty())
    <div>
        <h1 class="titular subrayado">Player History</h1>
    </div>
    <div class="past-players-container">
        @foreach ($team->getPastPlayers() as $player)
        <div class="d-flex mb-4">
            <!-- Información del jugador -->
            <div class="flex-grow-1 mr-3">
                <div class="d-flex align-items-center">
                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                        class="player-photo rounded-circle mr-3"
                        style="border-radius: 50%; width: 150px; height: 150px;">

                    <div class="player-info" style="width: 100%;">
                        <h3 class="titular">{{ $player->nick }}</h3>
                        <p class="comentarios">Role: <span>{{ $player->role->name }}</span></p>
                        <p class="comentarios">Start Date:
                            <span>{{ $player->pivot->start_date }}</span>
                        </p>
                        <p class="comentarios">End Date:
                            <span>{{ $player->pivot->contract_expiration_date }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Botones de acción -->
            <div class="d-flex flex-column">
                <button type="button" class="btn btn-boton9 btn-sm mb-2" data-bs-toggle="modal"
                    data-bs-target="#editModal{{ $player->id }}">Edit contract</button>
                <button type="button" class="btn btn-boton10 btn-sm mb-2" data-bs-toggle="modal"
                    data-bs-target="#deleteModal{{ $player->id }}">Delete vinculation</button>
            </div>
        </div>
        <hr class="custom-hr2">
        <!-- Modales para edición y eliminación, si es necesario -->
        @include('modals.modificate_player')
        @include('modals.eliminate')
        @endforeach
    </div>

@endif
                </div>
        </div>
    </div>
    <br>
    <script>
        document.getElementById('teamForm').addEventListener('submit', function(event) {
    const name = document.getElementById('name').value;
    const maxLength = 15;
    const specialCharPattern = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/; // regex para caracteres especiales

    let isValid = true;

    // Verificar que el nombre no supere el largo máximo y no contenga caracteres especiales
    if (name.length > maxLength || specialCharPattern.test(name)) {
        document.getElementById('nameError').textContent = 'Name must be less than 15 characters and not contain special characters.';
        isValid = false;
    } else {
        document.getElementById('nameError').textContent = '';
    }

    // Si no es válido, prevenir que el formulario se envíe
    if (!isValid) {
        event.preventDefault();
    }
});
    </script>
    <script>
        function teamData() {
            return {
                name: '{{ $team->name }}',
                logo: '{{ $team->logo }}',
                competition_id: '{{ $team->competition_id }}',
                competition_name: '{{ $team->competition->name }}',
                country: '{{ $team->country }}',
                logoData: '{{ $team->logo ? asset($team->logo) : '' }}',
                team_photoData: '{{ $team->team_photo ? asset($team->team_photo) : '' }}',
                logoPreview() {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.logoData = e.target.result;
                    };
                    reader.readAsDataURL(this.$refs.logo.files[0]);
                },
                team_photoPreview() {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.team_photoData = e.target.result;
                    };
                    reader.readAsDataURL(this.$refs.team_photo.files[0]);
                },
                updateCompetitionName() {
                    const selectedCompetition = this.$refs.competitionSelect.options[this.$refs.competitionSelect
                        .selectedIndex];
                    this.competition_name = selectedCompetition.text;
                }
            }
        }
    </script>
@endsection
