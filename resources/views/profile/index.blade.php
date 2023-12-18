@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/profile/comments.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/profile/getplayers.js') }}"></script>

@endsection
@section('content')

    <div class="container-fluid m-0 p-0">
        <div class="row m-0">
            <div class="col-12 p-0 profile-header"
                @if (Auth::user()->user_header_photo)
                    style="background: url('{{ asset(auth()->user()->user_header_photo) }}') no-repeat center center / cover;"
                @else
                    style="background-color: #333333;">
                @endif
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-12 p-0 profile-info">
                <img src="{{ asset(Auth::user()->user_photo) }}" alt="Icono del usuario" class="profile-icon">
                <div class="profile-text">
                    <h1>{{ Auth::user()->name }}</h1>
                    <div class="profile-accounts">
                        @if (Auth::user()->nick)
                            <p>{{ '@' . Auth::user()->nick }}</p>
                        @endif
                        @if (Auth::user()->discord)
                            <div class="account">
                                <img src="{{ asset('icons/discord.png') }}" alt="discord" style="width: 30px; height: 30px;">
                                <p>{{ Auth::user()->discord }}</p>
                            </div>
                        @endif
                        @if (Auth::user()->twitter)
                            <div class="account">
                                <img src="{{ asset('icons/twitter.png') }}" alt="twitter" style="width: 30px; height: 30px;">
                                <p>{{ Auth::user()->twitter }}</p>
                            </div>
                        @endif
                        @if (Auth::user()->birth_date)
                            <div class="account">
                                <p>{{ date('F jS', strtotime(Auth::user()->birth_date)) }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-0 justify-content-center">
            <div class="col-12 p-0 profile-links-container">
                <div class="profile-links">
                    <a href="#" id="comments-link"><img src="icons/comments.png" alt="Descripción de la imagen" />
                        Comments</a>

                    <a href="#" data-bs-toggle="modal" data-bs-target="#playersModal"><img src="icons/favorite.png" alt="Descripción de la imagen" /> Favorites</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal"><img src="icons/edit.png"
                            alt="Descripción de la imagen" /> Edit profile</a>
                    <a href="#"><img src="icons/gear.svg" alt="Descripción de la imagen" /> Configuracion</a>
                    <a href="#"><img src="icons/like.png" alt="Descripción de la imagen" /> Configuracion</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12 p-0 profile-comments-container">

        </div>
    </div>
    @include('modals.edit_profile')
    @include('modals.favorite_players')
    @endsection
