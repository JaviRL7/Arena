@extends('layouts.plantilla')

@section('title', 'Players admin create')

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/validation/player_create.js') }}" defer></script>
@endsection

@section('content')
    <div class="container mt-5" style="min-height: 80vh">
        <div x-data="playerData()" class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 shadow-sm">
                    <div class="mb-4">
                        <h1 class="titular subrayado">Create Player</h1>
                        <!-- Imagen de cabecera (fondo) -->
                        <div class="player-header mb-4"
                            style="background-image: url('{{ asset('default-background.jpg') }}');" x-show="imgData">
                            <img :src="imgData" alt="Player Background" class="img-fluid w-100"
                                style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Foto del jugador y detalles -->
                            <div class="d-flex align-items-center">
                                <div class="player-photo mr-3" x-show="photoData"
                                    style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; background: #fff;">
                                    <img :src="photoData" alt="Player Photo" class="img-fluid"
                                        style="height: 100%; object-fit: cover;">
                                </div>
                                <div>
                                    <h2 x-text="nick" class="titular"></h2>
                                    <p x-text="name" class="subtitular"></p>
                                    <p x-text="lastname1" class="comentarios"></p>
                                    <p x-text="lastname2" class="comentarios"></p>
                                    <p x-text="country" class="comentarios"></p>
                                    <p x-text="birth_date" class="comentarios"></p>
                                    <p x-text="role_name" class="comentarios"></p>
                                </div>
                            </div>
                        </div>
                        <hr class="custom-hr">
                    </div>
                    <form id="playerForm" action="{{ route('admin.players.store') }}" method="POST"
                        enctype="multipart/form-data" class="mt-4">
                        @csrf
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
                                    <label for="lastname1" class="form-label titular">First Lastname</label>
                                    <input type="text" id="lastname1" name="lastname1" class="form-control rounded-lg" x-model="lastname1">
                                    <span id="lastname1Error" class="text-danger"></span> <!-- Cambiado a lastname1Error -->
                                </div>
                                <div class="form-group mb-3">
                                    <label for="lastname2" class="form-label titular">Second Lastname</label>
                                    <input type="text" id="lastname2" name="lastname2" class="form-control rounded-lg" x-model="lastname2">
                                    <span id="lastname2Error" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nick" class="form-label titular">Nick</label>
                                    <input type="text" id="nick" name="nick" class="form-control rounded-lg"
                                        x-model="nick">
                                    <span id="nickError" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="photo" class="form-label titular">Photo</label>
                                    <input type="file" id="photo" name="photo" accept="image/*" class="form-control rounded-lg" x-ref="photo" @change="photoPreview">
                                    <span id="photoError" class="text-danger"></span>
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-6 pl-md-2">
                                <div class="form-group mb-3">
                                    <label for="country" class="form-label titular">Country</label>
                                    <input type="text" id="country" name="country" class="form-control rounded-lg" x-model="country">
                                    <span id="countryError" class="text-danger"></span> <!-- Agregado para mostrar errores del campo country -->
                                </div>

                                <div class="form-group mb-3">
                                    <label for="birth_date" class="form-label titular">Birth Date</label>
                                    <input type="date" id="birth_date" name="birth_date" class="form-control rounded-lg" x-model="birth_date">
                                    <span id="birthDateError" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="role_id" class="form-label titular">Role</label>
                                    <select id="role_id" name="role_id" class="form-control rounded-lg"
                                        x-model="role_id" @change="updateRoleName" x-ref="roleSelect">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="img" class="form-label titular">Header photo</label>
                                    <input type="file" id="img" name="img" accept="image/*" class="form-control rounded-lg" x-ref="img" @change="imgPreview">
                                    <span id="imgError" class="text-danger"></span>
                                </div>
                                <div class="d-grid gap-2 mt-4">
                                    <button id="submitBtn" type="submit" class="btn btn-boton7">Crear Jugador</button>
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
        function playerData() {
    return {
        name: '',
        lastname1: '',
        lastname2: '',
        nick: '',
        country: '',
        birth_date: '',
        role_id: '',
        role_name: '',
        photoData: '',
        imgData: '',
        photoPreview(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoData = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        imgPreview(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imgData = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        updateRoleName(event) {
            const selectedRole = this.$refs.roleSelect.options[this.$refs.roleSelect.selectedIndex];
            this.role_name = selectedRole.text;
        }
    }
}
    </script>
@endsection
