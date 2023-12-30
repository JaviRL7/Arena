@extends('layouts.plantilla')
@section('title', 'series show')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="custom-div-2">
                    <img src="{{ asset($serie->competition->logo) }}" alt="{{ $serie->competition->name }}" class="w-auto h-40 logo">
                    <h2>{{ $serie->competition->name }}</h2>
                    <h2>{{ $serie->name }}</h2>
                    <h2>{{ $serie->date }}</h2>
                    <h2>{{ $serie->type }}</h2>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editSerieModal" class="btn btn-primary d-block mb-2 edit-button">Edit serie</a>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid" >
                    <div class="table-responsive">


                        <table class="table_crud_admin mx-auto">
                            <thead>
                                <th>Team Blue Side</th>
                                <th>Result</th>
                                <th>Team Red Side</th>
                                <th>Number of the map</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($serie->games as $game)
                                    <tr class="row-color text-center">
                                        <td>
                                            <p>{{ $game->team_blue->name }}</p>
                                            <img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}"
                                                class="w-36 h-auto mx-auto d-block">
                                        </td>
                                        <td>
                                            <p>{{ $game->team_blue_result }}-{{ $game->team_red_result }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $game->team_red->name }}</p>
                                            <img src="{{ asset($game->team_red->logo) }}" alt="{{ $game->team_red->name }}"
                                                class="w-36 h-auto mx-auto d-block">
                                        </td>
                                        <td>
                                            <p>{{ $game->number }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.games.show', ['game' => $game]) }}"
                                                class="btn btn-primary d-block mb-2">Show this game</a>
                                                <a href="{{ route('admin.series.edit', ['serie' => $serie]) }}"
                                                    class="btn btn-primary d-block mb-2">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <!-- Ventana modal -->
    @include('modals.edit_series')

@endsection
