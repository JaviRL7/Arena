@extends('layouts.plantilla')
@section('title', 'series show')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12 games-table">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table_crud_admin mx-auto">
                    <thead>
                        <th>Team Blue Side</th>
                        <th>Result</th>
                        <th>Team Red Side</th>
                        <th>Number of the map</th>
                        <th>Competition</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($serie->games as $game)
                        <tr class="row-color text-center">
                            <td>
                                <p>{{$game->team_blue->name}}</p>
                                <img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}" class="w-36 h-auto mx-auto d-block">
                            </td>
                            <td>
                                <p>{{$game->team_blue_result}}-{{$game->team_red_result}}</p>
                            </td>
                            <td>
                                <p>{{$game->team_red->name}}</p>
                                <img src="{{ asset($game->team_red->logo) }}" alt="{{ $game->team_red->name }}" class="w-36 h-auto mx-auto d-block">
                            </td>
                            <td>
                                <p>{{$game->number}}</p>
                            </td>
                            <td>
                                <p>{{$serie->competition->name}}</p>
                            </td>
                            <td>
                                <a href="{{ route('admin.series.edit', ['serie' => $serie]) }}" class="btn btn-primary d-block mb-2">Edit</a>
                                <button type="button" class="btn btn-danger d-block" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $serie->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
