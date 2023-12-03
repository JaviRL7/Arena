
@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table_crud_admin">
                <thead>
                    <th>Blue side team</th>
                    <th>Result</th>
                    <th>Red side team</th>
                    <th>Number of the game</th>
                    <th>Serie</th>
                </thead>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                    <tr class="row-color">
                        <td>
                            <p>{{$game->team_blue->name}}</p>
                            <img src="{{ asset($game->team_blue->logo) }}" alt="" class="w-20 h-auto">
                        </td>
                        <td>
                            <p>{{ $game->team_blue_result }} - {{ $game->team_red_result }}</p>
                        </td>
                        <td>
                            <p>{{$game->team_red->name}}</p>
                            <img src="{{ asset($game->team_red->logo) }}" alt="" class="w-20 h-auto">
                        </td>
                        <td>
                            <p>{{$game->number}}</p>
                        </td>
                        <td>
                            <p>{{$game->serie->name}}</p>
                        </td>
                        <td>
                            <a href="{{ route('admin.games.show', ['game' => $game]) }}" class="text-blue">Show</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
