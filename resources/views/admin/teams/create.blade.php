@extends('layouts.plantilla')

@section('title', 'Teams admin create')

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/validation/team_create.js') }}" defer></script>
@endsection

@section('content')
<div class="container mt-5" style="min-height: 80vh">
    <div x-data="teamData()" class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-4 shadow-sm">
                <div class="mb-4">
                    <h1 class="titular subrayado">Create Team</h1>
                    <!-- Cabecera con la imagen de fondo (team photo) -->
                    <div class="player-header mb-4"
                            style="background-image: url('{{ asset('default-background.jpg') }}');" x-show="team_photoData">
                            <img :src="team_photoData" alt="Player Background" class="img-fluid w-100"
                                style="height: 200px; object-fit: cover;">
                        </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Logo del equipo y detalles -->
                        <div class="d-flex align-items-center">
                            <div class="team-logo mr-3" x-show="logoData" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; background: #fff;">
                                <img :src="logoData" alt="Team Logo" class="img-fluid" style="height: 100%; object-fit: cover;">
                            </div>
                            <div>
                                <h2 x-text="name" class="titular"></h2>
                                <p x-text="league_name" class="subtitular"></p>
                                <p x-text="country" class="comentarios"></p>
                            </div>
                        </div>
                    </div>
                    <hr class="custom-hr">
                </div>

                <form id="teamForm" action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6 pr-md-2">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label titular">Name</label>
                                <input type="text" id="name" name="name" class="form-control rounded-lg" x-model="name">
                                <span id="nameError" class="text-danger"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="league_id" class="form-label titular">League</label>
                                <select id="league_id" name="league_id" class="form-control rounded-lg" x-model="league_id" @change="updateLeagueName" x-ref="leagueSelect">
                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}">
                                            {{ $competition->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="leagueError" class="text-danger"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="country" class="form-label titular">Country</label>
                                <input type="text" id="country" name="country" class="form-control rounded-lg" x-model="country">
                                <span id="countryError" class="text-danger"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="logo" class="form-label titular">Logo</label>
                                <input type="file" id="logo" name="logo" accept="image/*" class="form-control rounded-lg" x-ref="logo" @change="logoPreview">
                                <span id="logoError" class="text-danger"></span>
                            </div>
                        </div>
                        <!-- Right Column -->
                        <div class="col-md-6 pl-md-2">
                            <div class="form-group mb-3">
                                <label for="team_photo" class="form-label titular">Team photo</label>
                                <input type="file" id="team_photo" name="team_photo" accept="image/*" class="form-control rounded-lg" x-ref="team_photo" @change="team_photoPreview">
                                <span id="teamPhotoError" class="text-danger"></span>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button id="submitBtn" type="submit" class="btn btn-boton7">Create Team</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<script>
    function teamData() {
        return {
            name: '',
            league_id: '',
            league_name: '',
            country: '',
            team_photoData: '',
            logoData: '',
            team_photoPreview(event) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.team_photoData = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            },
            logoPreview(event) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.logoData = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            },
            updateLeagueName(event) {
                const selectedLeague = this.$refs.leagueSelect.options[this.$refs.leagueSelect.selectedIndex];
                this.league_name = selectedLeague.text;
            }
        }
    }
</script>
<script>
    document.getElementById('teamForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const logo = document.getElementById('logo').files.length;
    const team_photo = document.getElementById('team_photo').files.length;

    let isValid = true;

    // Validación del nombre
    if (name.length < 2 || name.length > 15) {
        document.getElementById('nameError').textContent = 'Name must be between 2 and 15 characters.';
        isValid = false;
    } else {
        document.getElementById('nameError').textContent = '';
    }

    // Validación de las imágenes
    if (logo === 0) {
        document.getElementById('logoError').textContent = 'A logo must be selected.';
        isValid = false;
    } else {
        document.getElementById('logoError').textContent = '';
    }

    if (team_photo === 0) {
        document.getElementById('teamPhotoError').textContent = 'A header photo must be selected.';
        isValid = false;
    } else {
        document.getElementById('teamPhotoError').textContent = '';
    }

    if (isValid) {
        event.target.submit();
    }
});
</script>
@endsection
