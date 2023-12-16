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
                    <a href="#" id="comments-link"><img src="icons/comments.png" alt="Descripción de la imagen" />
                        Comments</a>
                    <a href="#"><img src="icons/favorite.png" alt="Descripción de la imagen" /> Favorites</a>
                    <a href="#"><img src="icons/edit.png" alt="Descripción de la imagen" /> Edit profile</a>
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

    <script>
        $(document).ready(function() {
            var commentsLoaded = false; // Variable de control para verificar si los comentarios ya se han cargado

            $('#comments-link').click(function(e) {
                e.preventDefault();

                // Si los comentarios ya se han cargado, no hagas nada
                if (commentsLoaded) {
                    return;
                }

                $.ajax({
                    url: '/profile/comments',
                    type: 'GET',
                    success: function(data) {
                        var commentsContainer = $('.profile-comments-container');
                        commentsContainer.append('<h1>These are all your comments</h1>');

                        $.each(data, function(i, comment) {
                            var commentDiv = $('<div/>', {
                                "class": "comment"
                            });
                            var commentHeader = $('<div/>', {
                                "class": "comment-header"
                            });
                            var userPhoto = $('<img/>', {
                                "src": comment.user.user_photo,
                                "class": "user-photo"
                            });
                            var userInfo = $('<div/>', {
                                "class": "user-info"
                            });
                            var userName = $('<p/>', {
                                "class": "user-name"
                            }).html('<strong>' + comment.user.name + '</strong>');
                            var userNick = $('<p/>', {
                                "class": "user-nick"
                            }).text('@' + comment.user.nick);
                            var commentDate = $('<span/>', {
                                "class": "comment-date"
                            }).text(comment.date);
                            var commentBody = $('<p/>', {
                                "class": "comment-body"
                            }).text(comment.body);
                            var commentLikesContainer = $('<div/>', {
                                "class": "comment-likes"
                            });
                            var likesImage = $('<img/>', {
                                "src": "/icons/mg_1.png",
                                "alt": "Icono de likes"
                            });
                            var likesCount = $('<p/>').text(comment.likes);
                            userInfo.append(userName, userNick);
                            commentHeader.append(userPhoto, userInfo, commentDate);
                            commentLikesContainer.append(likesImage, likesCount);
                            commentDiv.append(commentHeader, commentBody, commentLikesContainer);

                            // Agrega el comentario al nuevo contenedor
                            commentsContainer.append(commentDiv);
                        });

                        // Desplázate hacia el contenedor de comentarios después de agregarlos
                        $('html, body').animate({
                            scrollTop: commentsContainer.offset().top - ($(window)
                                .height() - commentsContainer.outerHeight()) / 2
                        }, 500);

                        // Marca los comentarios como cargados
                        commentsLoaded = true;
                    }
                });
            });
        });
    </script>
@endsection
