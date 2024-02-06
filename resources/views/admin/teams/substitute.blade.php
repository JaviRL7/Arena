@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

<div class="container my-4" style="min-height: 80vh">
    <div class="table-responsive">
        <form action="{{ route('teams.updateTitular', ['team' => $team->id]) }}" method="POST" class="mt-4">
            @csrf
            @foreach ($roles as $role)
                @php
                    $players = $team->getPlayersDate(\Carbon\Carbon::now())->where('role_id', $role->id);
                    $substitutes = $players->where('pivot.substitute', true);
                @endphp
                @if ($substitutes->count() > 0)
                    <div class="d-flex align-items-center mb-2">
                        <h1 class="titular mr-2">{{ $role->name }}</h1>
                        <img src="{{ asset($role->icono) }}" alt="{{ $role->name }}" class="role-logo">
                    </div>
                    <hr class="custom-hr">
                    <table class="table table-striped">
                        <thead></thead>
                        <tbody>
                            @foreach ($players as $player)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="player-photo mr-2">
                                        <div>
                                            <h2 class="titular mb-0">{{ $player->nick }}</h2>
                                            <p class="comentarios mb-0">{{ $player->name }} {{ $player->lastname }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="radio" name="titular[{{ $role->id }}]" value="{{ $player->id }}" {{ $player->pivot->substitute ? '' : 'checked' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="custom-hr">
                @endif
            @endforeach
            <button type="submit" class="btn btn-boton7">Update</button>
        </form>
    </div>
</div>

@endsection
