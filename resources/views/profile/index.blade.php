@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/profile/followings.js') }}"></script>

@endsection
@section('content')

    <div class="container-fluid ">
        <div class="row">
            <div class="col-12">

                <div class="container-new">

                    <div class="profile-header-new"
                        @if ($user->user_header_photo) style="background: url('{{ asset($user->user_header_photo) }}') no-repeat center center / cover;"
                        @else
                            style="background-color: #333333;" @endif>

                    </div>


                    <div class="profile-picture-container">
                        <img src="{{ asset($user->user_photo) }}" alt="Icono del usuario" class="profile-picture">
                    </div>

                    <div class="profile-info-new">
                        <h1 class="username">{{ $user->name }}</h1>
                        <span class="comentarios boton-follow">{{ '@' . $user->nick }}
                            @if (auth()->user() && auth()->user()->id != $user->id)
                                @php
                                    $userFollowing = auth()
                                        ->user()
                                        ->isFollowing($user);
                                @endphp
                                <form
                                    action="{{ $userFollowing ? route('unfollow', $user->id) : route('follow', $user->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-boton6" style="margin: 0%">
                                        {{ $userFollowing ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @endif
                        </span>

                        <div class="user-socials comentarios">
                            @if ($user->discord)
                                <p class="user-discord">
                                    <i class="fab fa-discord"></i> {{ $user->discord }}
                                </p>
                            @endif
                            @if ($user->twitter)
                                <p class="user-twitter">
                                    <i class="fab fa-twitter"></i> {{ $user->twitter }}
                                </p>
                            @endif
                            @if ($user->birth_date)
                                <p class="user-birthday">
                                    <i class="fas fa-birthday-cake"></i> {{ date('F jS', strtotime($user->birth_date)) }}
                                </p>
                            @endif
                        </div>
                        @if ($user->bio)
                            <!-- Reemplaza $user->bio con el nombre de la variable correcta para la biografía -->
                            <p class="user-bio comentarios">
                                {{ Str::limit($user->bio, 200) }} <!-- Limita a 200 caracteres -->
                            </p>
                        @endif
                        <div class="user-follow-stats">
                            <a href="#" id="followers-link" class="profile-link-item">

                                <span class="comentarios" style="margin: 5px">Followers</span> <span class="titular">
                                    {{ $user->followersCount() }}</span>
                            </a>
                            <a href="#" id="following-link" class="profile-link-item">
                                <span class="comentarios" style="margin: 5px">Following </span> <span
                                    class="titular">{{ $user->followingCount() }}</span>
                            </a>
                        </div>
                        <hr class="profile-divider"> <!-- Aquí agregamos el separador -->

                        <div class="profile-links">
                            <a href="#" id="comments-link" class="profile-link-item">
                                <i class="fas fa-comments"></i> Comments
                            </a>
                            <a href="#" id="favorites-link" class="profile-link-item">
                                <i class="fas fa-star"></i> Favorites
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal"
                                class="profile-link-item">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal"
                                class="profile-link-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <a href="#" class="profile-link-item">
                                <i class="fas fa-heart"></i> Your Likes
                            </a>
                        </div>
                        <div class="comments-container" style="display: none; margin-top:5%">

                            <p class="subtitular">"Comments by this user".</p>


                            @if ($user->comments->count() > 0)
                                @foreach ($user->comments as $comment)
                                    <div class="comment-container"> <!-- Añade esta clase -->
                                        @include('comments', ['comment' => $comment])
                                    </div>
                                @endforeach

                                @include('modals.delete_comment')
                                @include('modals.edit_comment')
                            @else
                                <p>No comments available.</p>
                            @endif

                        </div>
                        <div class="favorites-container" style="display: none; margin-top:5%">
                            <p class="subtitular">"My favorites".</p>

                            <x-favorite-players :user="$user" />
                        </div>
                        <div class="followers-container" style="display: none; margin-top:5%">
                            <p class="subtitular">"My followers".</p>
                            <x-followers :followers="$user->followers" />
                            </div>

                        <!-- Contenedor para Following -->
                        <div class="following-container" style="display: none; margin-top:5%">
                            <p class="subtitular">"My followings".</p>
                            <x-following :following="$user->followings" />
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="row m-0">
        <div class="col-md-12 p-0 profile-comments-container">

        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12 p-0 profile-followings-container">
        </div>
    </div>
    @include('modals.edit_profile')
    @include('modals.favorite_players')
    @include('modals.configure')

    <script>
        var userId = {{ $user->id }};
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén el botón y el contenedor de comentarios
            const commentsButton = document.getElementById('comments-link');
            const commentsContainer = document.querySelector('.comments-container');

            // Escucha el evento de clic en el botón de comentarios
            commentsButton.addEventListener('click', function() {
                // Alternar la visibilidad del contenedor de comentarios
                commentsContainer.style.display = commentsContainer.style.display === 'none' ? 'block' :
                    'none';
            });
        });




        $(document).ready(function() {
            // ... tu otro código ...

            $('.link-muted').click(function(e) {
                e.preventDefault();

                var href = $(this).attr('href'); // Obtiene la URL del enlace
                var likeLink = $(this); // Guarda el enlace de 'like' para usarlo en la respuesta

                $.ajax({
                    url: href,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Encuentra el contador de 'likes' relacionado con este enlace y actualízalo
                            likeLink.closest('.comment-container').find('.likes-count').text(
                                response.likesCount);
                        }
                    },
                    error: function(error) {
                        // Maneja cualquier error aquí
                        console.log(error);
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const commentsButton = document.getElementById('comments-link');
            const favoritesButton = document.getElementById('favorites-link'); // Nuevo botón para favoritos
            const commentsContainer = document.querySelector('.comments-container');
            const favoritesContainer = document.querySelector(
            '.favorites-container'); // Nuevo contenedor para favoritos

            // Función para ocultar todos los contenedores
            function hideAllContainers() {
                commentsContainer.style.display = 'none';
                favoritesContainer.style.display = 'none';
            }

            // Evento de clic para el botón de comentarios
            commentsButton.addEventListener('click', function() {
                hideAllContainers();
                commentsContainer.style.display = 'block';
            });

            // Evento de clic para el botón de favoritos
            favoritesButton.addEventListener('click', function() {
                hideAllContainers();
                favoritesContainer.style.display = 'block';
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const followersLink = document.getElementById('followers-link');
            const followingLink = document.getElementById('following-link');
            const followersContainer = document.querySelector('.followers-container');
            const followingContainer = document.querySelector('.following-container');

            // Función para ocultar todos los contenedores
            function hideAllContainers() {
                // ... otros contenedores ...
                followersContainer.style.display = 'none';
                followingContainer.style.display = 'none';
            }

            // Evento de clic para el enlace de Followers
            followersLink.addEventListener('click', function() {
                hideAllContainers();
                followersContainer.style.display = 'block';
            });

            // Evento de clic para el enlace de Following
            followingLink.addEventListener('click', function() {
                hideAllContainers();
                followingContainer.style.display = 'block';
            });
        });
    </script>
@endsection
