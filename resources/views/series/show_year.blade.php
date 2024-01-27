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
<br>
<br>

<div class="container-fluid" style="min-height: 80vh;">
    @if ($series->where('name', 'Finale')->count() > 0)
        <h2 class="titulo">Finale</h2>
        <x-carousel :series="$series" name="Finale" />
    @endif

    @if ($series->where('name', 'Semi-final')->count() > 0)
        <h2 class="titulo">Semi-finals</h2>
        <x-carousel :series="$series" name="Semi-final" />
    @endif

    @if ($series->where('name', 'Quarterfinals')->count() > 0)
        <h2 class="titulo">Quarterfinals</h2>
        <x-carousel :series="$series" name="Quarterfinals" />
    @endif

    @if ($series->where('name', 'Regular split')->count() > 0)
        <h2 class="titulo">Regular split</h2>
        <x-regular-split :series="$series" />
    @endif
</div>
