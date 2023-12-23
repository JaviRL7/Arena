@extends('layouts.plantilla')
@section('title', 'Players admin edit')
@section('content')

    <div x-data="{
        name: '{{ $player->name }}',
        lastname1: '{{ $player->lastname1 }}',
        lastname2: '{{ $player->lastname2 }}',
        nick: '{{ $player->nick }}',
        country: '{{ $player->country }}',
        birth_date: '{{ $player->birth_date }}',
        role_id: '{{ $player->role_id }}'
    }">
        <div>
            <h2>Previsualización:</h2>
            <p>Nombre: <span x-text="name"></span></p>
            <p>Primer apellido: <span x-text="lastname1"></span></p>
            <p>Segundo apellido: <span x-text="lastname2"></span></p>
            <p>Nick: <span x-text="nick"></span></p>
            <p>País: <span x-text="country"></span></p>
            <p>Fecha de nacimiento: <span x-text="birth_date"></span></p>
            <p>Rol: <span x-text="role_id"></span></p>
        </div>
        <form action="{{ route('admin.players.update', $player) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-crud">
                <div style="background-color: white; border: 2px solid #e44445; border-radius: 15px; padding: 20px; display: flex; flex-wrap: wrap; justify-content: space-between;">
                    <!-- Left Column -->
                    <div style="flex: 1 0 45%; margin: 20px; padding-right: 10px; border-right: 1px solid #000;">
                        <div class="form-group row">
                            <label for="name" class="label-crud">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="input-crud" x-model="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname1" class="label-crud">First Lastname</label>
                            <div class="col-sm-10">
                                <input type="text" name="lastname1" class="input-crud" x-model="lastname1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname2" class="label-crud">Second Lastname</label>
                            <div class="col-sm-10">
                                <input type="text" name="lastname2" class="input-crud" x-model="lastname2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nick" class="label-crud">Nick</label>
                            <div class="col-sm-10">
                                <input type="text" name="nick" class="input-crud" x-model="nick">
                            </div>
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div style="flex: 1 0 45%; margin: 20px; padding-left: 10px;">
                        <div class="form-group row">
                            <label for="country" class="label-crud">Country</label>
                            <div class="col-sm-10">
                                <input type="text" name="country" class="input-crud" x-model="country">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birth_date" class="label-crud">Birth Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="birth_date" class="input-crud rounded-lg" x-model="birth_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role_id" class="label-crud">Role</label>
                            <div class="col-sm-10">
                                <select name="role_id" class="input-crud rounded-lg" x-model="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $player->role_id == $role->id ? 'selected' : '' }}>

                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="label-crud">Photo</label>
                            <div class="col-sm-10">
                                <input type="file" name="photo" accept="image/*" class="input-crud rounded-lg">
                            </div>
                        </div>
                    </div>
                    <!-- Botón de Envío -->
                    <div style="width: 100%; text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn btn-outline-success">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
