
@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('content')

    <div class="container-fluid m-0">
        <div class="row">
            <div class="col-md-12 m-0" >
                <div class="profile-header" style="background: url('URL-de-la-imagen-de-fondo'); background-color: grey;">
                    <img src="{{ asset(Auth::user()->user_photo) }}" alt="Icono del usuario" class="profile-icon">
                    <div class="profile-info">
                        <h1>{{ Auth::user()->name }}</h1>
                        <p>{{ '@' . Auth::user()->nick }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="profile-links">
                    <a href="#">Enlace 1</a>
                    <a href="#">Enlace 2</a>
                    <a href="#">Enlace 3</a>

                </div>
            </div>
        </div>
    </div>


@endsection
