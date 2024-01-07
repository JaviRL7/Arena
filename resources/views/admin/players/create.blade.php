@extends('layouts.plantilla')

@section('title', 'Players admin create')

@section('content')
<div class="container edit-player-container">
    <div x-data="{
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
        photoPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoData = e.target.result;
            };
            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
        imgPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imgData = e.target.result;
            };
            reader.readAsDataURL(this.$refs.img.files[0]);
        },
        updateRoleName() {
            const selectedRole = this.$refs.roleSelect.options[this.$refs.roleSelect.selectedIndex];
            this.role_name = selectedRole.text;
        }
    }">
        <!-- Preview -->
        <div>
            <h2>Preview:</h2>
            <p>Name: <span x-text="name"></span></p>
            <p>First Lastname: <span x-text="lastname1"></span></p>
            <p>Second Lastname: <span x-text="lastname2"></span></p>
            <p>Nick: <span x-text="nick"></span></p>
            <p>Country: <span x-text="country"></span></p>
            <p>Birth Date: <span x-text="birth_date"></span></p>
            <p>Role: <span x-text="role_name"></span></p>
            <img x-show="photoData" :src="photoData" style="width: 100px;">
            <img x-show="imgData" :src="imgData" style="width: 100px;">
        </div>
        <!-- Form -->
        <form action="{{ route('admin.players.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                    <option value="{{ $role->id }}">
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
                        <label for="img" class="label-crud">Img</label>
                        <div class="col-sm-10 archivo mi-div-unico">
                            <input type="file" name="img" accept="image/*" class="input-crud rounded-lg" x-ref="img" @change="imgPreview" id="file-input-img" style="display: none;">
                            <label for="file-input-img" style="color: #e44445; cursor: pointer;">Select a file</label>
                        </div>
                    </div>
                </div>
                <div style="width: 100%; text-align: center; margin-top: 20px;">
                    <button type="submit" class="btn" style="background-color: white; color: #e44445; border: 2px solid #e44445; margin-left: 165px;">Create</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    @endsection
