@extends('layouts.plantilla')

@section('title', 'show games')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/serie.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/serie/carrusel.js') }}"></script>
@endsection

@section('content')


<div class="container-fluid" style="min-height: 80vh; margin-top:5%">
    @foreach (array_keys($competitionsByYear) as $year)
    <strong><h2 class="año">Season {{ $year }}</h2></strong>
    <div class="d-flex justify-content-center flex-wrap">
        @foreach ($competitionsByYear[$year] as $competition)
        <div class="m-3 text-center">
                <a href="{{ route('series.show_year', ['competition' => $competition->id, 'year' => $year]) }}" class="series-selector">
                    <img src="{{ asset($competition->logo) }}" alt="{{ $competition->name }}">
                </a>
                <h5>{{ $competition->name }}</h5>
            </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection
