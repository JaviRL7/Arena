@extends('layouts.plantilla')
@section('title', 'Players index')

@section('content')
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nick</th>
                    <th>Nombre</th>
                    <th>Role</th>
                    <th>Current team</th>
                    <th>Birth date</th>
                    <th>Contract expiration</th>
                    <th>Country</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($players as $player)
                <tr class="row-color">
                    <td>
                        <img src="{{ asset($player->photo) }}" alt="{{ $player_blue->photo }}"
                        class="w-36 h-36 object-cover rounded-full">
                    </td>
                    <td>
                        <p>{{ $player->nick }}</p>
                            <span class="text-gray-500">{{ $player->name }}
                                {{ $player->lastname1 }}
                            </span>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection
