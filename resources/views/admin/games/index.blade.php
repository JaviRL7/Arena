@extends('layouts.plantilla_admin')
@section('title', 'Games index')

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/admin/change.js') }}"></script>

@endsection
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<button id="toggleView" class="btn btn-secondary">Change to mode series</button>


<div class="row justify-content-center" id="gamesTable">
    <div class="row justify-content-left mt-4">
        <div class="col-md-12 create-game">
            <div style="display: flex; justify-content: space-between;">
                <h2>Do you want to create a new game?</h2>
                <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Crear</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table_crud_admin">
                    <thead>
                        <th>Blue side team</th>
                        <th>Result</th>
                        <th>Red side team</th>
                        <th>Number of the game</th>
                        <th>Serie</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($games as $game)
                        <tr class="row-color">
                            <td>
                                <div class="team">
                                    <p class="team-name">{{$game->team_blue->name}}</p>
                                    <img src="{{ asset($game->team_blue->logo) }}" alt="" class="team-logo w-20 h-auto">
                                </div>
                            </td>
                            <td>
                                <p>{{ $game->team_blue_result }} - {{ $game->team_red_result }}</p>
                            </td>
                            <td>
                                <div class="team">
                                    <p class="team-name">{{$game->team_red->name}}</p>
                                    <img src="{{ asset($game->team_red->logo) }}" alt="" class="team-logo w-20 h-auto">
                                </div>
                            </td>

                            <td>
                                <p>{{$game->number}}</p>
                            </td>
                            <td>
                                <p>{{$game->serie->name}}</p>
                            </td>
                            <td>
                                <a href="{{ route('admin.games.show', ['game' => $game]) }}" class="btn btn-primary">Show</a> <br>
                                <!-- Botón de "Eliminar" que abre la ventana modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $game->id }}">
                                    Delete
                                </button>
                            </td>
                            @include('modals.delete_games')
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex; justify-content: left;">
                    {{ $games->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row justify-content-center" id="seriesTable" style="display: none;">
    <div class="row justify-content-left mt-4">
        <div class="col-md-12 create-game">
            <div style="display: flex; justify-content: space-between;">
                <h2>Do you want to create a new series?</h2>
                <a href="{{ route('admin.series.create') }}" class="btn btn-primary">Crear</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table_crud_admin">
                    <thead>
                        <th>Team 1</th>
                        <th>Result</th>
                        <th>Team 2</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($series as $serie)
                        <tr class="row-color">
                            <td>
                                <p>{{ $serie->team_1->name }}</p>
                                <img src="{{ asset($serie->team_1->logo) }}" alt="" class="w-20 h-auto">
                            </td>
                            <td>
                                <p>{{ $serie->getResultSerie() }}</p>
                            </td>
                            <td>
                                <p>{{ $serie->team_2->name }}</p>
                                <img src="{{ asset($serie->team_2->logo) }}" alt="" class="w-20 h-auto">
                            </td>
                            <td>
                                <a href="" class="btn btn-primary">Show</a> <br>
                                <!-- Botón de "Eliminar" que abre la ventana modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $serie->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex; justify-content: left;">
                    {{ $series->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<br>
@endsection
