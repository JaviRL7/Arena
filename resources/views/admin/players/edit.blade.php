@extends('layouts.plantilla')
@section('title', 'Players admin edit')

@section('content')
    <div class="container mt-5" style="min-height: 80vh">
        <div x-data="playerData()" class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 shadow-sm">
                    <div class="mb-4">

                        <!-- Cabecera con la imagen de fondo y la foto del jugador -->
                        <div class="player-header"
                            style="background-image: url('{{ $player->img ? asset($player->img) : '' }}'); height: 400px; background-size: cover; background-position: center; position: relative;">
                            <div
                                style="width: 150px; height: 150px; position: absolute; bottom: -75px; left: 50%; transform: translateX(-50%); background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 3px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">
                                <img x-show="photoData" :src="photoData" alt="Player Photo" class="rounded-circle"
                                    style="width: 100%; height: auto;">
                            </div>
                        </div>

                        <!-- Datos básicos del jugador bajo la cabecera -->
                        <div class="player-info mt-5 mb-3 text-center" style="padding-top: 100px;">
                            <!-- Aumento el padding-top para dar más espacio -->
                            <h1 class="titular"><span x-text="nick"></span></h1>
                            <h2 class="subtitular"><span
                                    x-text="name + ' ' + lastname1 + (lastname2 ? ' ' + lastname2 : '')"></span></h2>
                            <p class="comentarios"><span x-text="country"></span>, <span x-text="birth_date"></span></p>
                            <p class="comentarios"><span x-text="role_name"></span></p>
                        </div>


                        <!-- Mensaje de errores -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <hr class="custom-hr">

                        <!-- Formulario de edición -->
                        <form action="{{ route('admin.players.update', $player) }}" method="POST"
                            enctype="multipart/form-data" class="mt-4">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6 pr-md-2">
                                    <!-- Campos de texto -->
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label titular">Name</label>
                                        <input type="text" id="name" name="name" class="form-control rounded-lg"
                                            x-model="name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="lastname1" class="form-label titular">First Lastname</label>
                                        <input type="text" id="lastname1" name="lastname1"
                                            class="form-control rounded-lg" x-model="lastname1">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="lastname2" class="form-label titular">Second Lastname</label>
                                        <input type="text" id="lastname2" name="lastname2"
                                            class="form-control rounded-lg" x-model="lastname2">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nick" class="form-label titular">Nick</label>
                                        <input type="text" id="nick" name="nick" class="form-control rounded-lg"
                                            x-model="nick">
                                    </div>
                                </div>
                                <!-- Right Column -->
                                <div class="col-md-6 pl-md-2">
                                    <div class="form-group mb-3">
                                        <label for="country" class="form-label titular">Country</label>
                                        <input type="text" id="country" name="country" class="form-control rounded-lg"
                                            x-model="country">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="birth_date" class="form-label titular">Birth Date</label>
                                        <input type="date" id="birth_date" name="birth_date"
                                            class="form-control rounded-lg" x-model="birth_date">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="role_id" class="form-label titular">Role</label>
                                        <select id="role_id" name="role_id" class="form-control rounded-lg"
                                            x-model="role_id" x-on:change="updateRoleName">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $player->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="photo" class="form-label titular">Photo</label>
                                        <input type="file" id="photo" name="photo" accept="image/*"
                                            class="form-control rounded-lg" x-ref="photo" x-on:change="photoPreview">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="img" class="form-label titular">Background photo</label>
                                        <input type="file" id="img" name="img" accept="image/*"
                                            class="form-control rounded-lg" x-ref="img" x-on:change="imgPreview">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-boton7">Update Player</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        function playerData() {
            return {
                name: '{{ $player->name }}',
                lastname1: '{{ $player->lastname1 }}',
                lastname2: '{{ $player->lastname2 ?? '' }}',
                nick: '{{ $player->nick }}',
                country: '{{ $player->country }}',
                birth_date: '{{ $player->birth_date }}',
                role_id: '{{ $player->role_id }}',
                role_name: '{{ $player->role->name }}',
                photoData: '{{ $player->photo ? asset($player->photo) : '' }}',
                imgData: '{{ $player->img ? asset($player->img) : '' }}',
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
