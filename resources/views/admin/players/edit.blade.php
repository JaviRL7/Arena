@extends('layouts.plantilla')
@section('title', 'Players admin edit')
@section('content')
    <div class="container edit-player-container">
        <div x-data="{
            name: '{{ $player->name }}',
            lastname1: '{{ $player->lastname1 }}',
            lastname2: '{{ $player->lastname2 }}',
            nick: '{{ $player->nick }}',
            country: '{{ $player->country }}',
            birth_date: '{{ $player->birth_date }}',
            role_id: '{{ $player->role_id }}',
            role_name: '{{ $player->role->name }}',
            photoData: '{{ $player->photo ? asset($player->photo) : '' }}',
            imgData: '{{ $player->img ? asset($player->img) : '' }}',
    imgPreview() {
        const reader = new FileReader();
        reader.onload = (e) => {
            this.imgData = e.target.result;
        };
        reader.readAsDataURL(this.$refs.img.files[0]);
    },
            photoPreview() {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoData = e.target.result;
                };
                reader.readAsDataURL(this.$refs.photo.files[0]);
            },
            updateRoleName() {
                const selectedRole = this.$refs.roleSelect.options[this.$refs.roleSelect.selectedIndex];
                this.role_name = selectedRole.text;
            }
        }">
        <div style="background-color: #e44445; color: white; padding: 20px; display: flex; flex-wrap: wrap; justify-content: space-between; border-radius: 15px">
            <div style="flex: 1 0 45%; margin: 20px; display: flex;">
                <div style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; background-color: white;">
                    <img x-show="photoData" :src="photoData" style="width: 100%;">
                </div>
                <div style="margin-left: 50px;">
                    <h1><span x-text="nick"></span></h1>
                    <h3><span x-text="name"></span></h3>
                    <h3><span x-text="lastname1"></span></h3>
                    <h3><span x-text="lastname2"></span></h3>
                </div>
            </div>
            <div style="flex: 1 0 30%; margin: 20px;">

                <h3> <span x-text="country"></span></h3>
                <h3> <span x-text="birth_date"></span></h3>
                <h3> <span x-text="role_name"></span></h3>
            </div>
            <div style="flex: 1 0 30%; margin: 20px;">
                <img x-show="imgData" :src="imgData" style="width: 400px; border-radius: 15px;">

            </div>
        </div>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form action="{{ route('admin.players.update', $player) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-crud" style="background-color: white; border: 2px solid #e44445; border-radius: 15px; padding: 20px; display: flex; flex-wrap: wrap; justify-content: space-between;">
                    <!-- Left Column -->
                    <div class="separador" style="flex: 1 0 45%; margin: 20px; padding-right: 10px; border-right: 1px solid #000;">
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
                    <div class="separador" style="flex: 1 0 45%; margin: 20px; padding-left: 10px;">
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
                                <select name="role_id" class="input-crud rounded-lg" x-model="role_id" @change="updateRoleName" x-ref="roleSelect">
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
                            <div class="col-sm-10 archivo mi-div-unico">
                                <input type="file" name="photo" accept="image/*" class="input-crud rounded-lg" x-ref="photo" @change="photoPreview" id="file-input" style="display: none;">
                                <label for="file-input" style="color: #e44445; cursor: pointer;">Select a file</label>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="img" class="label-crud">Background photo
                            </label>
                            <div class="col-sm-10 archivo mi-div-unico">
                                <input type="file" name="img" accept="image/*" class="input-crud rounded-lg" x-ref="img" @change="imgPreview" id="img-input" style="display: none;">
                                <label for="img-input" style="color: #e44445; cursor: pointer;">Select a file</label>
                            </div>
                        </div>


                    </div>
                    <div style="width: 100%; text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn" style="background-color: white; color: #e44445; border: 2px solid #e44445; margin-left: 165px;">Modificate</button>
                    </div>
            </form>
        </div>
    </div>
    <br>
@endsection
