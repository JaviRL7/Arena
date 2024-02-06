@extends('layouts.plantilla_admin')
@section('title', 'Games index')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/players/.js') }}" defer></script>

@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<!-- Bloque para crear una nueva serie -->
<div class="container my-4">
    <div class="row justify-content-end">
        <div class="col-auto d-flex align-items-center">
            <h6 class="comentarios mr-3">Create a new series</h6>
            <a href="{{ route('admin.series.create') }}" class="btn btn-boton7" style="margin: 0">Add</a>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="container-fluid">

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Team 1</th>
                        <th>Result</th>
                        <th>Team 2</th>
                        <th>Type of the series</th>
                        <th>Competition</th>
                        <th>Actions</th>

                    </tr>
                    <tr>
                        <td colspan="6" class="separator-custom"></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($series as $serie)
                        <tr class="row-color">
                            <td class="">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_2->name }}" class="team-logo">
                                </div>
                                <p class="comentarios">{{ $serie->team_1->name }}</p>
                            </td>
                            <td>
                                <p class="comentarios">{{ $serie->getResultSerie() }}</p>
                            </td>
                            <td class="">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}" class="team-logo">
                                </div>
                                <p class="comentarios">{{ $serie->team_2->name }}</p>
                            </td>
                            <td>
                                <p class="comentarios">{{ $serie->name }}</p>
                            </td>
                            <td class="">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($serie->competition->logo) }}" alt="{{ $serie->competition->name }}" class="team-logo">
                                </div>
                                <p class="comentarios">{{ $serie->competition->name }}</p>
                            </td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.series.show', ['serie' => $serie]) }}" class="btn btn-boton7">Edit</a>
                                <button type="button" class="btn btn-boton8" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $serie->id }}">Delete</button>
                            </td>
                        </tr>
                        @include('modals.series_delete')
                    @empty
                        <tr>
                            <td colspan="6">No series found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-custom">
                {{ $series->links() }}
            </div>
        </div>
    </div>
</div>

<br><br>
@endsection
