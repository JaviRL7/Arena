@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/profile/comments.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/profile/showplayers.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/profile/getplayers.js') }}"></script>
@endsection
@section('content')

    <div class="container-fluid m-0 p-0">
        <div class="row m-0">
            <div class="col-12 p-0 profile-header"
                @if ($user->user_header_photo) style="background: url('{{ asset($user->user_header_photo) }}') no-repeat center center / cover;"
@else
style="background-color: #333333;"> @endif
                </div>

            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 profile-info">
                    <img src="{{ asset($user->user_photo) }}" alt="Icono del usuario" class="profile-icon">
                    <div class="profile-text">
                        <h1>{{ $user->name }}</h1>
                        <div class="profile-accounts">
                            @if ($user->nick)
                                <p>{{ '@' . $user->nick }}</p>
                            @endif
                            @if ($user->discord)
                                <div class="account">
                                    <img src="{{ asset('icons/discord.png') }}" alt="discord"
                                        style="width: 30px; height: 30px;">
                                    <p>{{ $user->discord }}</p>
                                </div>
                            @endif
                            @if ($user->twitter)
                                <div class="account">
                                    <img src="{{ asset('icons/twitter.png') }}" alt="twitter"
                                        style="width: 30px; height: 30px;">
                                    <p>{{ $user->twitter }}</p>
                                </div>
                            @endif
                            @if ($user->birth_date)
                                <div class="account">
                                    <p>{{ date('F jS', strtotime($user->birth_date)) }}</p>
                                </div>
                            @endif
                            @if (auth()->user() && auth()->user()->id != $user->id)
                                @php
                                    $userFollowing = auth()
                                        ->user()
                                        ->isFollowing($user);
                                    $userFollowed = $user->isFollowing(auth()->user());
                                @endphp

                                <form
                                    action="{{ $userFollowing ? route('unfollow', $user->id) : route('follow', $user->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $userFollowing ? 'btn-secondary' : 'btn-primary' }}">
                                        {{ $userFollowing ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>

                                @if ($userFollowing && $userFollowed)
                                    <span>Mutuals <i class="fa fa-heart"></i></span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 p-0 profile-links-container">
                <div class="profile-links">
                    <a href="#" id="comments-link"><img src="{{ asset('icons/comments.png') }}"
                            alt="Descripción de la imagen" />
                        Comments</a>
                    <a href="#" id="favorites-link"><img src="{{ asset('icons/favorite.png') }}"
                            alt="Descripción de la imagen" />
                        Favorites</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal"><img
                            src="{{ asset('icons/edit.png') }}" alt="Descripción de la imagen" /> Edit profile</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal">
                        <img src="{{ asset('icons/gear.svg') }}" alt="Descripción de la imagen" /> Settings</a>
                    <a href="#">
                        <img src="{{ asset('icons/like.png') }}" alt="Descripción de la imagen" /> Your likes</a>
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
    @include('modals.configure')
    <script>
        var userId = {{ $user->id }};
    </script>
@endsection
