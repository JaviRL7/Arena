@extends('layouts.plantilla')

@section('title', 'Teams admin create')

@section('content')
    <div class="container edit-team-container">
        <div x-data="{
            name: '',
            league_id: '',
            country: '',
            team_photoData: '',
            logoData: '',
            team_photoPreview() {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.team_photoData = e.target.result;
                };
                reader.readAsDataURL(this.$refs.team_photo.files[0]);
            },
            logoPreview() {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.logoData = e.target.result;
                };
                reader.readAsDataURL(this.$refs.logo.files[0]);
            }
        }">
            <!-- Preview -->
            <div
                style="background-color: #e44445; color: white; padding: 20px; display: flex; justify-content: space-between; border-radius: 15px">
                <div style="flex: 1 0 45%; margin: 20px;">
                    <h2>Preview:</h2>
                    <p>Name: <span x-text="name"></span></p>
                    <p>League ID: <span x-text="league_id"></span></p>
                    <p>Country: <span x-text="country"></span></p>
                </div>
                <div style="flex: 1 0 45%; margin: 20px;">
                    <img x-show="team_photoData" :src="team_photoData" style="width: 100px;">
                    <img x-show="logoData" :src="logoData" style="width: 100px;">
                </div>
            </div>
            <br>

            <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-crud"
                    style="background-color: white; border: 2px solid #e44445; border-radius: 15px; padding: 20px; display: flex; flex-wrap: wrap; justify-content: space-between;">
                    <!-- Left Column -->
                    <div class="separador"
                        style="flex: 1 0 45%; margin: 20px; padding-right: 10px; border-right: 1px solid #000;">
                        <div class="form-group row">
                            <label for="name" class="label-crud">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="input-crud" x-model="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="league_id" class="label-crud">League ID</label>
                            <div class="col-sm-10">
                                <select name="league_id" class="input-crud rounded-lg" x-model="league_id">
                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}">
                                            {{ $competition->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="label-crud">Country</label>
                            <div class="col-sm-10">
                                <input type="text" name="country" class="input-crud" x-model="country">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="team_photo" class="label-crud">Team Photo</label>
                            <div class="col-sm-10 archivo mi-div-unico">
                                <input type="file" name="team_photo" accept="image/*" class="input-crud rounded-lg"
                                    x-ref="team_photo" @change="team_photoPreview" id="file-input" style="display: none;">
                                <label for="file-input" style="color: #e44445; cursor: pointer;">Select a file</label>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="separador" style="flex: 1 0 45%; margin: 20px; padding-left: 10px;">
                        <div class="form-group row">
                            <label for="logo" class="label-crud">Logo</label>
                            <div class="col-sm-10 archivo mi-div-unico">
                                <input type="file" name="logo" accept="image/*" class="input-crud rounded-lg"
                                    x-ref="logo" @change="logoPreview" id="file-input-img" style="display: none;">
                                <label for="file-input-img" style="color: #e44445; cursor: pointer;">Select a file</label>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn"
                            style="background-color: white; color: #e44445; border: 2px solid #e44445; margin-left: 165px;">Create</button>
                    </div>
            </form>
        </div>
        <br>
    @endsection
