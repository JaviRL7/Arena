@extends('layouts.plantilla')
@section('title', 'Teams admin edit')
@section('content')

    <div class="container">
        <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-crud">
                <div class="form-group row">
                    <label for="name" class="label-crud">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="input-crud" value="{{ $team->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="league_id" class="label-crud">League</label>
                    <div class="col-sm-10">

                        <select name="league_id" class="input-crud rounded-lg">
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}" {{ $team->league_id == $competition->id ? 'selected' : '' }}>
                                    {{ $competition->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <img src="{{ asset($team->logo) }}" alt="{{ $team->logo }}"
                                class="w-36 h-36">
                    <br>
                    <label for="loog" class="label-crud"><br>Team logo</label>
                    <div class="col-sm-10">
                        <input type="file" name="logo" accept="image/*" class="input-crud rounded-lg">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <a href="{{ route('admin.teams.add', ['team' => $team]) }}" class="btn btn-primary">Add a new player</a>
                    </div>
                </div>
                <hr style="border-top: 1px solid gray;">

                @foreach ($team->getPlayers() as $player)
                    @php
                        $pivot = $player
                            ->teams()
                            ->where('team_id', $team->id)
                            ->first()->pivot;
                    @endphp
                    <div class="form-group">
                        <p style="font-size: 1.5rem;">{{ $player->role->name }} : {{ $player->nick }}</p>

                        <br>
                        <label for="player" class="label-crud">Start date of the contract of the {{$player->nick}} player in the {{$player->role->name}} position : {{ $pivot->start_date }} <br><br> Do you want to change it </label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date_{{$player->id}}" class="input-crud" value="{{ $pivot->start_date }}">
                        </div>
                        <br>
                        <br>
                        <label for="player" class="label-crud">End date of the contract of the {{$player->nick}} player in the {{$player->role->name}} position : {{ $pivot->start_date }}. <br><br> Do you want to change it ?</label>
                        <div class="col-sm-10">
                            <input type="date" name="end_date_{{$player->id}}" class="input-crud" value="{{ $pivot->end_date }}">
                        </div>
                    </div>
                    <hr style="border-top: 1px solid gray;">

                @endforeach
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-outline-success">Enviar</button>
            </div>
        </form>
    </div>
@endsection
