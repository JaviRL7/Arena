@extends('layouts.plantilla')
@section('title', 'Teams admin edit')
@section('content')
<div class="container">

<form method="POST" action="{{ route('admin.teams.add_player', ['team' => $team->id]) }}">    @csrf
    <div class="form-group">
        <label for="player_id">Jugador</label>
        <select class="form-control" id="player_id" name="player_id">
            @foreach($players as $player)
                <option value="{{ $player->id }}">{{ $player->nick }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="start_date">Fecha de inicio</label>
        <input type="date" class="form-control" id="start_date" name="start_date">
    </div>
    <div class="form-group">
        <label for="contract_expiration_date">Fecha de fin de contrato</label>
        <input type="date" class="form-control" id="contract_expiration_date" name="contract_expiration_date">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
</div>
@endsection
