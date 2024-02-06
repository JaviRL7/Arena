@extends('layouts.plantilla')
@section('title', 'series show')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@endsection
@section('content')
    <div class="container mt-5" style="min-height: 80vh">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="shadow-sm">

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Logo de la competición y detalles -->
                        <div class="d-flex align-items-center mr-3">
                            <img src="{{ asset($serie->competition->logo) }}" alt="{{ $serie->competition->name }}" class="competition-logo mr-3">
                            <div class="ml-7"> <!-- Agregado margen a la izquierda -->
                                <h3 class="titular">{{ $serie->competition->name }}</h3>
                                <p class="comentarios">{{ $serie->name }}</p>
                                <p class="comentarios">{{ $serie->date }}</p>
                                <p class="comentarios">{{ $serie->type }}</p>
                            </div>
                        </div>

                        <!-- Resultados y logos de los equipos -->
                        <div class="d-flex align-items-center mr-3">
                            <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_1->name }}" class="team-logo mr-5">
                            <p class="titular mx-5">{{ $serie->getResultSerie() }}</p> <!-- Agregado margen a los lados -->
                            <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}" class="team-logo ml-5">
                        </div>

                        <!-- Botón de editar -->
                        <div>
                            <button class="btn btn-boton7" data-bs-toggle="modal" data-bs-target="#editSerieModal">Edit Serie</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <hr class="custom-hr">

        <div class="table-responsive">
            <table class="table-custom mx-auto">
                <thead>
                    <tr>
                        <th>Team Blue Side</th>
                        <th>Result</th>
                        <th>Team Red Side</th>
                        <th>Number of the Map</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serie->games as $game)
                        <tr class="row-color">
                            <td class="">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}" class="team-logo">
                                </div>
                                <p class="comentarios">{{ $game->team_blue->name }}</p>
                            </td>
                            <td class="text-center">
                                <p class="comentarios">{{ $game->team_blue_result }} - {{ $game->team_red_result }}</p>
                            </td>
                            <td class="">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($game->team_red->logo) }}" alt="{{ $game->team_red->name }}" class="team-logo">
                                </div>
                                <p class="comentarios">{{ $game->team_red->name }}</p>
                            </td>
                            <td class="text-center">
                                <p class="comentarios">{{ $game->number }}</p>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.games.show', ['game' => $game]) }}" class="btn btn-boton7 btn-block">Edit</a>
                                <button type="button" class="btn btn-boton8 btn-block" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            </td>
                        </tr>
                        @include('modals.delete_game')
                    @endforeach
                </tbody>
            </table>
        </div>


@if($serie->canAddGame())
<a href="{{ route('admin.games.create', ['serie' => $serie->id]) }}" class="btn btn-boton7">Add Game</a>
    @endif
    </div>
    </div>
    </div>

    @include('modals.edit_series')
@endsection
