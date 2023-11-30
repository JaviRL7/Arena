
@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table_crud_admin">
                <thead>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>League</th>
                    <th>Current players</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                    <tr class="row-color">
                        <td>
                            <img src="{{ asset($team->logo) }}" alt="{{ $team->logo }}"
                                class="w-36 h-36">
                        </td>
                        <td>
                            <p>
                                {{ $team->name }}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $team->competition->name }}
                            </p>
                        </td>
                        <td>
                            <p>
                                @foreach ($team->getPlayers() as $player)
                                {{ $player->role->name }} : {{ $player->nick }} <br>
                                @endforeach
                            </p>
                        </td>
                        <td>
                            <a href="{{ route('admin.teams.edit', ['team' => $team]) }}" class="text-blue">Modificate</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
