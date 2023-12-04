@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
<form action="/games" method="POST">
    @csrf

    <label for="team_blue_id">Equipo Azul:</label>
    <select name="team_blue_id" id="team_blue_id">
        @foreach ($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>

    <label for="team_red_id">Equipo Rojo:</label>
    <select name="team_red_id" id="team_red_id">
        @foreach ($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>

    <label for="ban1_blue">Ban 1 Azul:</label>
    <select name="ban1_blue" id="ban1_blue">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban2_blue">Ban 2 Azul:</label>
    <select name="ban1_blue" id="ban1_blue">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban3_blue">Ban 3 Azul:</label>
    <select name="ban1_blue" id="ban1_blue">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban4_blue">Ban 4 Azul:</label>
    <select name="ban1_blue" id="ban1_blue">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban5_blue">Ban 5 Azul:</label>
    <select name="ban1_blue" id="ban1_blue">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>

    <label for="ban1_red">Ban 1 red:</label>
    <select name="ban1_red" id="ban1_red">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban2_red">Ban 2 red:</label>
    <select name="ban1_red" id="ban1_red">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban3_red">Ban 3 red:</label>
    <select name="ban1_red" id="ban1_red">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban4_red">Ban 4 red:</label>
    <select name="ban1_red" id="ban1_red">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <label for="ban5_red">Ban 5 red:</label>
    <select name="ban1_red" id="ban1_red">
        @foreach ($champions as $champion)
            <option value="{{ $champion->id }}">{{ $champion->name }}</option>
        @endforeach
    </select>
    <h2>Jugadores</h2>

    @foreach ($players as $player)
        <h3>{{ $player->name }}</h3>

        <label for="champion_id_{{ $player->id }}">Campeón:</label>
        <select name="champion_id_{{ $player->id }}" id="champion_id_{{ $player->id }}">
            @foreach ($champions as $champion)
                <option value="{{ $champion->id }}">{{ $champion->name }}</option>
            @endforeach
        </select>

        <label for="kills_{{ $player->id }}">Kills:</label>
        <input type="number" name="kills_{{ $player->id }}" id="kills_{{ $player->id }}">

        <label for="deaths_{{ $player->id }}">Deaths:</label>
        <input type="number" name="deaths_{{ $player->id }}" id="deaths_{{ $player->id }}">

        <label for="assists_{{ $player->id }}">Assists:</label>
        <input type="number" name="assists_{{ $player->id }}" id="assists_{{ $player->id }}">
    @endforeach

    <button type="submit">Crear Juego</button>
</form>
@endsection
