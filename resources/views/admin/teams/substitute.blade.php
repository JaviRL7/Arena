@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

<div class="container-fluid" style="min-height: 80vh">
    <div class="table-responsive tabla-sustituto">
        <form action="{{ route('teams.updateTitular', ['team' => $team->id]) }}" method="POST">
            @csrf
            @foreach ($roles as $role)
                @php
                    $players = $team->getPlayersDate(\Carbon\Carbon::now())->where('role_id', $role->id);
                    $substitutes = $players->where('substitute', true);
                @endphp
                @if ($substitutes->count() > 0)
                    <h1>{{ $role->name }}</h1>
                    <img src="{{ asset($role->icono) }}" alt="{{ $role->name }}" class="role-logo">
                    <table class="table table-striped">
                        <thead>

                        </thead>
                        <tbody>
                            @foreach ($players as $player)
                                <tr>
                                    <td><img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-photo"></td>
                                    <td><h2>{{ $player->nick }}</h2></td>
                                    <td>
                                        <input type="radio" name="titular[{{ $role->id }}]" value="{{ $player->id }}" {{ $player->substitute ? '' : 'checked' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endforeach
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
