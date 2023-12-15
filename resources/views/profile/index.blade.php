@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('content')

<div class="container-fluid m-0 p-0">
    <div class="row m-0">
        <div class="col-12 p-0 profile-header">
            <img src="{{ asset(Auth::user()->user_photo) }}" alt="Icono del usuario" class="profile-icon">
            <div class="profile-info">
                <h1>{{ Auth::user()->name }}</h1>
                <p>{{ '@' . Auth::user()->nick }}</p>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-12 p-0 profile-links-container">
            <div class="profile-links">
                <a href="#" id="comments-link"><img src="icons/comments.png" alt="Descripción de la imagen" /> Comments</a>
                <a href="#"><img src="icons/favorite.png" alt="Descripción de la imagen" /> Favorites</a>
                <a href="#"><img src="icons/edit.png" alt="Descripción de la imagen" /> Edit profile</a>
                <a href="#"><img src="icons/gear.svg" alt="Descripción de la imagen" /> Configuracion</a>
                <a href="#"><img src="icons/like.png" alt="Descripción de la imagen" /> Configuracion</a>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#comments-link').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: '/profile/comments',
            type: 'GET',
            success: function(data) {
                var commentsDiv = $('<div/>');
                $.each(data, function(i, comment) {
                    commentsDiv.append('<p>' + comment.body + '</p>');
                });
                $('.profile-links-container').after(commentsDiv);
            }
        });
    });
});
</script>
@endsection
