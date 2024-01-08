
@extends('layouts.plantilla_admin')
@section('title', 'Players index')

@section('content')

    <div class="container-fluid">
        <div class="col-md-12 create-game">
            <div style="display: flex; justify-content: space-between;">
                <h2>Do you want to create a new team?</h2>
                <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table_crud_admin">
                <thead>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>League</th>
                    <th>Jugadores por año</th>
                    <th>Current players</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                    <tr class="row-color">
                        <td>
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->logo }}"
                                class="w-36 h-auto">
                        </td>
                        <td>
                            <h5>
                                {{ $team->name }}
                            </h5>
                        </td>

                            <td>
                                <h5>
                                    {{ $team->competition->name ?? '' }}
                                </h5>
                            </td>

                        <td>
                            <h5>
                                @foreach ($team->getPlayersByYear(2022) as $player)
                                    {{ $player->nick }}
                                @endforeach
                            </h5>
                        </td>
                        <td>
                            <h5>
                                @foreach ($team->getPlayersDate(\Carbon\Carbon::now())->where('pivot.substitute', false) as $player)
                                    {{ $player->role->name }} : {{ $player->nick }} <br>
                                @endforeach
                            </h5>

                            <h5>
                                @foreach ($team->getPlayersSubstitute() as $player)
                                Substitutes : {{ $player->nick }} <br>
                                @endforeach
                                <a href="{{ route('admin.teams.substitute', ['team' => $team]) }}" class="text-blue">Modificate Sustitute</a>
                            </h5>
                        </td>
                        <td>
                            <button onclick="location.href='{{ route('admin.teams.edit', ['team' => $team]) }}'" class="boton1">Modificate</button><br>
                            <button type="button" class="boton2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $team->id }}">
                                Delete
                            </button>
                        </td>

                    </tr>
                    @include('modals.delete_team')

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
