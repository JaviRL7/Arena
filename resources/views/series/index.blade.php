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

<h2 class="titulo" style="margin-left: 25%">Finale</h2>
<x-carousel :series="$series" name="Finale" />

<h2 class="titulo" style="margin-left: 25%">Semi-final</h2>
<x-carousel :series="$series" name="Semi-final" />

<h2 class="titulo" style="margin-left: 25%">Quarterfinals</h2>
<x-carousel :series="$series" name="Quarterfinals" />

@endsection
