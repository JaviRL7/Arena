
@extends('layouts.plantilla_admin')
@section('title', 'Players index')

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
                                class="w-36 h-auto">
                        </td>
                        <td>
                            <h5>
                                {{ $team->name }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $team->competition->name }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                @foreach ($team->getPlayersDate(\Carbon\Carbon::now())->where('substitute', false) as $player)
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
                            <a href="{{ route('admin.teams.edit', ['team' => $team]) }}" class="text-blue">Modificate</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
