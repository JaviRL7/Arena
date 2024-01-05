@extends('layouts.plantilla_admin')
@section('title', 'Users index')

@section('content')

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table_crud_admin">
                <thead>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Nick</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Validated</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="row-color">
                        <td>
                            <img src="{{ asset($user->user_photo) }}" alt="{{ $user->nick }}"
                                class="w-36 h-36 object-cover rounded-full">
                        </td>
                        <td>
                            <h5>
                                {{ $user->name }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $user->nick }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $user->email }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $user->admin ? 'Yes' : 'No' }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $user->validated ? 'Yes' : 'No' }}
                            </h5>
                        </td>
                        <td>
                            <div>
                                <form method="GET" action="{{ route('profile.index', $user) }}">
                                    @csrf
                                    <button type="submit" class="boton1">Show</button>
                                </form>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('admin.user.validate', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="boton3">Validate</button>
                                </form>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('admin.user.invalidate', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="boton2">Invalidate</button>
                                </form>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="boton4">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: left;">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
