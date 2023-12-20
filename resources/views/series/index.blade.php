@extends('layouts.plantilla')
@section('title', 'show games')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @foreach ($series as $serie)
                    <p>{{$serie->name}}</p>
                    <p>{{$serie->team_red}}-{{$serie->getResultSerie()}}</p>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>HOLAAAA</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
@endsection
