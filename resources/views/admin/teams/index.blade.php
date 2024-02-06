@extends('layouts.plantilla_admin')
@section('title', 'Teams Index')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('content')
<style>
    /* Añade tus estilos personalizados aquí */
</style>

<div class="container my-4">
    <div class="row justify-content-end">
        <div class="col-auto d-flex align-items-center">
            <h6 class="comentarios mr-3">Do you want to create a new team?</h6>
            <a href="{{ route('admin.teams.create') }}" class="btn btn-boton7" style="margin:0%">Create</a>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>League</th>
                        <th>Last season roster</th>
                        <th>Current Players</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <td colspan="6" class="separator-custom"></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teams as $team)
                        <tr class="row-color">
                            <td class="team-logo-cell">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($team->logo) }}" alt="{{ $team->name }}" class="team-logo">
                                </div>
                            </td>

                            <td class="titular">
                                {{ $team->name }}
                            </td>
                            <td class="comentarios">
                                {{ $team->competition->name ?? 'N/A' }}
                            </td>
                            <td class="comentarios">
                                @foreach ($team->getPlayersByYear(2023) as $player)
                                    {{ $player->nick }} <br>
                                @endforeach
                            </td>
                            <td class="comentarios">
                                @foreach ($team->getPlayersDate(\Carbon\Carbon::now())->where('pivot.substitute', false) as $player)
                                    {{ $player->role->name }}: {{ $player->nick }} <br>
                                @endforeach
                                @php
                                    $substitutes = $team->getPlayersDate(\Carbon\Carbon::now())->where('pivot.substitute', true);
                                @endphp
                                @if(count($substitutes) > 0)
                                    Substitutes:
                                    @foreach ($substitutes as $player)
                                        {{ $player->nick }} <br>
                                    @endforeach
                                    <a href="{{ route('admin.teams.substitute', ['team' => $team]) }}" class="text-blue">Modificate Substitute</a>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.teams.edit', ['team' => $team]) }}" class="btn btn-boton7">Edit</a>
                                <button type="button" class="btn btn-boton8" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $team->id }}">Delete</button>
                            </td>
                        </tr>
                        @include('modals.delete_team')
                    @empty
                        <tr>
                            <td colspan="6">No teams found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-custom">
                {{ $teams->links() }}
            </div>
        </div>
    </div>
</div>

<br><br>
@endsection
