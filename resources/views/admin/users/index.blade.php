@extends('layouts.plantilla_admin')
@section('title', 'Users Index')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')


    <div class="container my-4">
        <div class="row justify-content-end">
            <div class="col-auto d-flex align-items-center">
                <h6 class="comentarios mr-3">Manage Users</h6>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Nick</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Validated</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td colspan="7" class="separator-custom"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="row-color">
                                <td class="user-photo-cell">
                                    <div class="d-flex justify-content-center">

                                        <img src="{{ asset($user->user_photo) }}" alt="{{ $user->nick }}"
                                            class="user-photo">
                                    </div>
                                </td>
                                <td class="comentarios">
                                    {{ $user->name }}
                                </td>
                                <td class="comentarios">
                                    {{ $user->nick }}
                                </td>
                                <td class="comentarios">
                                    {{ $user->email }}
                                </td>
                                <td class="comentarios">
                                    {{ $user->admin ? 'Yes' : 'No' }}
                                </td>
                                <td class="comentarios">
                                    {{ $user->validated ? 'Yes' : 'No' }}
                                </td>
                                <td class="action-buttons">
                                    <a href="{{ route('profile.index', $user) }}" class="btn btn-boton7">Show</a>
                                    <form method="POST" action="{{ route('admin.user.validate', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-boton9">Validate</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.user.invalidate', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-boton8">Invalidate</button>
                                    </form>
                                    <button type="button" class="btn btn-boton10" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @include('modals.delete_user')
                        @empty
                            <tr>
                                <td colspan="7">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-custom">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <br><br>
@endsection
