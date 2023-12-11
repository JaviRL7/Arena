
@extends('layouts.plantilla')
@section('title', 'Players index')
@section('content')

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table_crud_admin">
                <thead>
                    <th>Photo</th>
                    <th>Nick</th>
                    <th>Nombre</th>
                    <th>Role</th>
                    <th>Current team</th>
                    <th>Historial teams</th>
                    <th>Birth date</th>
                    <th>Conthact expiration</th>
                    <th>Counthy</th>
                    <th>actions</tr>
                </thead>
                <tbody>
                    @foreach ($players as $player)
                    <tr class="row-color">
                        <td>
                            <img src="{{ asset($player->photo) }}" alt="{{ $player->photo }}"
                                class="w-36 h-36 object-cover rounded-full">
                        </td>
                        <td>
                            <p>{{ $player->nick }}</p>
                        </td>
                        <td>
                            <span class="text-gray-500">{{ $player->name }}
                                {{ $player->lastname1 }}
                            </span>
                        </td>
                        <td>
                            <p>
                                {{ $player->role->name }}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $player->mostPlayedChampion()->name}}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $player->teams()->where('start_date', '<=', $today)->where('contract_expiration_date', '>=', $today)->first()->name }}
                            </p>
                        </td>
                        <td>
                            <p>
                                @foreach ($player->teams as $team)
                                    {{ $team->name }}
                                @endforeach
                            </p>
                        </td>
                        <td>
                            <p>
                                {{ $player->birth_date }}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{$player->currentTeam()->pivot->contract_expiration_date;}}
                            </p>
                        </td>
                        <td>
                            <p>
                                {{$player->country;}}
                            </p>
                        </td>
                        <td>
                            <a href="{{ route('admin.players.edit', ['player' => $player]) }}" class="text-blue">Modificar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
