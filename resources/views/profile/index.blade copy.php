@extends('layouts.plantilla')
@section('title', 'profile')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/profile/comments.js') }}"></script>
@endsection
@section('content')

    <div class="container-fluid m-0 p-0">
        <div class="row m-0">
            <div class="col-12 p-0 profile-header"
                style="background: url('{{ asset(auth()->user()->user_header_photo) }}') no-repeat center center / cover;">
                <img src="{{ asset(Auth::user()->user_photo) }}" alt="Icono del usuario" class="profile-icon">
                <div class="profile-info">
                    <h1> {{ Auth::user()->name }}</h1>
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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal"><img src="icons/edit.png"
                            alt="Descripción de la imagen" /> Edit profile</a> <a href="#"><img src="icons/gear.svg"
                            alt="Descripción de la imagen" /> Configuracion</a>
                    <a href="#"><img src="icons/like.png" alt="Descripción de la imagen" /> Configuracion</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12 p-0 profile-comments-container">

        </div>
    </div>



    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar perfil</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!--Div para la user_header_photo-->
                    <div
                        style="width: 100%; height: 200px; background-image: url('{{ asset(Auth::user()->user_header_photo) }}'); background-size: cover; background-position:center;">
                    </div>

                    <form action="{{ asset('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!--Imagen de user_photo-->
                        <div class="mb-3 modal_user_photo">
                            <!-- Contenedor de la foto de perfil -->
                            <div>
                                <img src="{{ asset(Auth::user()->user_photo) }}" alt="Foto de perfil" class="modal-user-photo">
                                <!-- Nueva imagen de add_photo.png -->
                                <label for="user_photo" class="form-label">
                                    <img src="{{ asset('icons/add_photo.png') }}" alt="Agregar foto" class="add-photo-icon">
                                </label>
                            </div>
                            <!-- Input para user_photo -->
                            <input type="file" class="form-control visually-hidden" id="user_photo" name="user_photo">
                        </div>


                        <!--Imagen de user_header_photo-->
                        <div class="mb-3 position-relative">
                            <label for="user_header_photo" class="form-label position-absolute top-0 end-0">
                                <!--Imagen de edit-->

                                <input type="file" class="form-control visually-hidden" id="user_header_photo"
                                    name="user_header_photo">
                            </label>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
