@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/profile/general.js') }}"></script>

@endsection
@section('content')

    <div class="container-fluid " style="min-height: 100vh">
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
                                    @if ($userFollowing)
                                        @method('DELETE')
                                    @endif
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
                            <p class="user-points">
                                <i class="fas fa-star"></i> {{ $user->points }}
                            </p>
                            @if (Auth::user()->validated)
                                <p class="text-success"><i class="fas fa-check-circle"></i> Validated</p>
                            @else
                                <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Banned account.</p>
                            @endif
                        </div>
                        @if ($user->bio)
                            <p class="user-bio comentarios">
                                {{ Str::limit($user->bio, 200) }}</p>
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
                            @if ($user->hasFavoriteTeamWithLogo())
                            <div class="favorite-team-logo" style="display: flex; align-items: center; margin-left: 10px;">
                                <img src="{{ asset($user->getFavoriteTeam()->logo) }}" alt="Favorite Team Logo" style="height: 30px;">
                                <span class="titular">{{ '#' . $user->getFavoriteTeam()->name . '_WIN' }}</span>
                            </div>
                            @endif


                        </div>
                        <hr class="custom-hr">

                        <div class="profile-links">
                            <a href="#" id="reviews-link" class="profile-link-item">
                                <i class="fas fa-pencil-alt"></i> Reviews
                            </a>
                            <a href="#" id="comments-link" class="profile-link-item">
                                <i class="fas fa-comments"></i> Comments
                            </a>
                            <a href="#" id="favorites-link" class="profile-link-item">
                                <i class="fas fa-star"></i> Favorites
                            </a>
                            {{-- Mostrar solo si el usuario logueado está viendo su propio perfil --}}
                            @if (auth()->user() && auth()->user()->id == $user->id)
                                <a href="#" id="for-you-link" class="profile-link-item">
                                    <i class="fas fa-heart"></i> For you
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal"
                                    class="profile-link-item">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal"
                                    class="profile-link-item">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            @endif
                        </div>
                        <div class="comments-container" style="display: none; margin-top:5%">

                            <p class="subtitular">"Comments by this user".</p>


                            @if ($user->comments->count() > 0)
                                @foreach ($user->comments as $comment)
                                    <div class="comment-container"> <!-- Añade esta clase -->
                                        @include('comments', ['comment' => $comment])

                                    </div>
                                @endforeach
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
                            <x-followers :followers="$followers" />
                        </div>

                        <div class="following-container" style="display: none; margin-top:5%">
                            <p class="subtitular">"My followings".</p>
                            <x-following :followings="$followings" />
                        </div>

                        <div class="for-you-activities-container" style="display: none; margin-top:5%">
                            <p class="subtitular">"Activities from users you follow".</p>
                            <x-profile-activities :activities="$activities" />
                        </div>

                        <div class="reviews-container" style="display: none; margin-top:5%">
                            <p class="subtitular">"Reviews by this user".</p>
                            <x-user-reviews :scores="$reviews" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.edit_profile')
    @include('modals.favorite_players')
    @include('modals.configure')
    @include('modals.delete_comment')
    @if ($user->comments->isNotEmpty())
        @include('modals.edit_comment')
        @include('modals.admin-comments')
    @endif

@endsection
