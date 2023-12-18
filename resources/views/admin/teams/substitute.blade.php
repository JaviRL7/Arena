
@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table_crud_admin">
                <thead>
                    <th>Logo</th>
                    <th>Name</th>

                </thead>
                <tbody>
                    @foreach ($players as $player)
                    <tr class="row-color">
                        <td>
                            <img src="{{ asset($player->photo) }}" alt="{{ $player->nick }}"
                                class="w-36 h-36">
                        </td>
                        <td>
                            <p>{{ $player->nick }}</p>
                        </td>
                        <td>
                            <a href="{{ route('admin.teams.index', ['team' => $team]) }}" class="text-blue">volver</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.players.updateSubstitute', ['player' => $player]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">
                                    {{ $player->substitute ? 'Set False' : 'Set True' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
