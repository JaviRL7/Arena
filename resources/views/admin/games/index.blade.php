@extends('layouts.plantilla_admin')
@section('title', 'Games index')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row justify-content-center" id="seriesTable">
    <div class="row justify-content-left mt-4">
        <div class="col-md-12 create-game">
            <div style="display: flex; justify-content: space-between;">
                <h2>Do you want to create a new series?</h2>
                <a href="{{ route('admin.series.create') }}" class="btn btn-primary">Create</a>
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
                        <th>Type of the series</th>
                        <th>Competition</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($series as $serie)
                        <tr class="row-color">
                            <td>
                                <div style="text-align: center;">
                                    <p style=" margin-bottom: 0;">{{ $serie->team_1->name }}</p>
                                    <img src="{{ asset($serie->team_1->logo) }}" alt="" class="w-20 h-auto" style="display: block; margin: auto;">
                                </div>
                            </td>
                            <td>
                                <p>{{ $serie->getResultSerie() }}</p>
                            </td>
                            <td>
                                <div style="text-align: center;">
                                    <p style=" margin-bottom: 0;">{{ $serie->team_2->name }}</p>
                                    <img src="{{ asset($serie->team_2->logo) }}" alt="" class="w-20 h-auto" style="display: block; margin: auto;">
                                </div>
                            </td>
                            <td>
                                <p>{{ $serie->name }}</p>
                            </td>
                            <td>
                                <div style="text-align: center;">
                                    <p style=" margin-bottom: 0;">{{ $serie->competition->name }}</p>
                                    <img src="{{ asset($serie->competition->logo) }}" alt="" class="w-20 h-auto" style="display: block; margin: auto;">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.series.show', ['serie' => $serie]) }}" class="btn btn-primary">Show</a>
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
