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
                    <th>Birth Date</th>
                    <th>Twitter</th>
                    <th>Discord</th>
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
                            <h5>
                                {{ $user->birth_date }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $user->twitter }}
                            </h5>
                        </td>
                        <td>
                            <h5>
                                {{ $user->discord }}
                            </h5>
                        </td>
                        <td>
                            <div>
                                <a href="{{ route('profile.show', $user->id) }}" class="text-blue">Show</a>
                            </div>
                            <div>
                                <a href="{{ route('admin.user.validate', $user->id) }}" class="text-blue">Validate</a>
                            </div>
                            <div>
                                <a href="{{ route('admin.user.destroy', $user->id) }}" class="text-blue">Delete</a>
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
