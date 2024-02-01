@extends('layouts.plantilla')

@section('title', 'Teams index')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/players.css') }}">
@endsection
@section('content')
    <div class="container2">

        <div x-data="{ search: '' }">
            <input type="text" x-model="search" placeholder="Search by player's nick..." class="form-control rounded-pill">

            @foreach ($roles as $role)
                <h1 class="titulo">{{ $role->name }}</h1>
                <hr class="custom-hr2">

                <div class="row">
                    @foreach ($players as $player)
                        @if ($player->role_id == $role->id)
                            <div class="col-md-4"
                                x-show="!search || '{{ $player->nick }}'.toLowerCase().includes(search.toLowerCase())">
                                <a href="{{ route('players.profile', $player->id) }}" class="text-decoration-none">
                                    <div class="player-img-container">
                                        <img src="{{ $player->img }}" class="players-img" alt="{{ $player->nick }}">
                                    </div>
                                    <div class="">
                                        <h2 class="titular">{{ $player->nick }}</h2>
                                        <h4 class="subtitular">{{ $player->name }} {{ $player->lastname1 }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
