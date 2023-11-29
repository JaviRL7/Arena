@extends('layouts.plantilla')
@section('title', 'Players admin edit')
@section('content')
<div class="container">
    <form action="{{ route('admin.players.update', $player) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-crud">
            <div class="form-group row">
                <label for="name" class="label-crud">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="input-crud" value="{{ $player->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastname1" class="label-crud">Firts lastname</label>
                <div class="col-sm-10">
                    <input type="text" name="lastname1" class="input-crud"
                        value="{{ $player->lastname1 }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="lastname2" class="label-crud">Second lastname</label>
                <div class="col-sm-10">
                    <input type="text" name="lastname2" class="input-crud"
                        value="{{ $player->lastname2 }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="nick" class="label-crud">Nick</label>
                <div class="col-sm-10">
                    <input type="text" name="nick" class="input-crud" value="{{ $player->nick }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="label-crud">Country</label>
                <div class="col-sm-10">
                    <input type="text" name="country" class="input-crud"
                        value="{{ $player->country }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="label-crud">Photo</label>
                <div class="col-sm-10">
                    <input type="file" name="photo" accept="image/*" class="input-crud rounded-lg">
                </div>
            </div>
            <div class="form-group row">
                <label for="birth_date" class="label-crud">Birth date</label>
                <div class="col-sm-10">
                    <input type="date" name="birth_date" value="{{ $player->birth_date }}"
                        class="input-crud rounded-lg">
                </div>
            </div>
            <div class="form-group row">
                <label for="role_id" class="label-crud">Role</label>
                <div class="col-sm-10">

                    <select name="role_id" class="input-crud rounded-lg">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $player->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-outline-success">Enviar</button>
        </div>
    </form>
</div>
@endsection
