@extends('layouts.plantilla_admin')
@section('title', 'Games index')


@section('content')
<div class="row justify-content-left mt-4">
    <div class="col-md-12 create-game">
        <div style="display: flex; justify-content: space-between;">
            <h2>Do you want to create a new game?</h2>
            <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Crear</a>
        </div>
    </div>
</div>
<br>
<br>@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row justify-content-center">
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
                <div style="display: flex; justify-content: center; font-size: 1.5em;">
                    {{ $games->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection
