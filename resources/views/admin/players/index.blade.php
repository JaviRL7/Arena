@extends('layouts.plantilla_admin')
@section('title', 'Players index')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('content')
<div class="container my-4">
    <div class="row justify-content-end">
        <div class="col-auto d-flex align-items-center">
            <h6 class="comentarios mr-3">Create a new player</h6>
            <a href="{{ route('admin.players.create') }}" class="btn btn-boton7" style="margin: 0">Add</a>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Nick</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Current team</th>
                        <th>Contract expiration</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <td colspan="7" class="separator-custom"></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($players as $player)
                        <tr class="row-color">
                            <td class="team-info2">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            </td>
                            <td>
                                <p class="titular">{{ $player->nick }}</p>
                            </td>
                            <td>
                                <p class="comentarios">{{ $player->name }} {{ $player->lastname1 }}</p>
                            </td>
                            <td>
                                <p class="comentarios">{{ $player->role->name }}</p>
                            </td>
                            <td class="team-info2">
                                <p class="titular">{{ $player->teams()->where('start_date', '<=', $today)->where('contract_expiration_date', '>=', $today)->first()->name ?? 'Free agent' }}</p>
                            </td>
                            <td>
                                <p class="titular">{{ $player->currentTeam()->pivot->contract_expiration_date ?? 'LFT' }}</p>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.players.edit', ['player' => $player]) }}" class="btn btn-boton7">Edit</a>
                                <a href="{{ route('players.profile', ['id' => $player->id]) }}" class="btn btn-boton9">Show</a>
                                <button type="button" class="btn btn-boton8" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $player->id }}">Delete</button>
                            </td>
                        </tr>
                        @include('modals.delete')
                    @empty
                        <tr>
                            <td colspan="7">No players found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-custom">
                {{ $players->links() }}
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection
