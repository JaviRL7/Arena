@extends('layouts.plantilla')

@section('title', 'Create a new series')

@section('content')
    <div class="container create-series-container" style="height: 80vh">
            <div
                style="background-color: #e44445; color: white; padding: 20px; display: flex; justify-content: space-between; border-radius: 15px">
                <h1 style="width: 100%; text-align: center;">Create a new series</h1>
            </div>
            <br>
            <form action="{{ route('admin.series.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-crud"
                    style="background-color: white; border: 2px solid #e44445; border-radius: 15px; padding: 20px; display: flex; justify-content: space-between;">
                    <!-- Left Column -->
                    <div class="separador"
                        style="flex: 1 0 45%; margin: 20px; padding-right: 10px; border-right: 1px solid #000;">
                        <div class="form-group row">
                            <label for="competition" class="label-crud">Competition</label>
                            <div class="col-sm-10">
                                <select id="competition" name="competition_id" class="input-crud rounded-lg">

                                    <option value="">No competition selected</option>

                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="team1" class="label-crud">Team 1</label>
                            <div class="col-sm-10">
                                <select id="team1" name="team1" class="input-crud rounded-lg">
                                    <option value="">No team selected</option>

                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="team2" class="label-crud">Team 2</label>
                            <div class="col-sm-10">
                                <select id="team2" name="team2" class="input-crud rounded-lg">
                                    <option value="">No team selected</option>

                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="separador" style="flex: 1 0 45%; margin: 20px; padding-left: 10px;">

                        <div class="form-group row">
                            <label for="type" class="label-crud">Type</label>
                            <div class="col-sm-10">
                                <select id="type" name="type" class="input-crud rounded-lg">
                                    <option value="bo1">BO1</option>
                                    <option value="bo3">BO3</option>
                                    <option value="bo5">BO5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="label-crud">Name</label>
                            <div class="col-sm-10">
                                <select id="name" name="name" class="input-crud rounded-lg">
                                    <option value="Finale">Finale</option>
                                    <option value="Semi-finals">Semi-finals</option>
                                    <option value="Quarterfinals">Quarterfinals</option>
                                    <option value="Regular split">Regular split</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="label-crud">Date</label>
                            <div class="col-sm-10">
                                <input type="date" id="date" name="date" class="input-crud rounded-lg">
                            </div>
                        </div>
                        <div class="form-group" style="justify-content: left;">
                            <button type="submit" class="btn"
                                style="margin-top: 25px; background-color: white; color: #e44445; border: 2px solid #e44445; padding: 10px 20px;">Create
                                Series</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <br>
@endsection
