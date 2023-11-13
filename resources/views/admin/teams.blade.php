@extends('layouts.admin')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $team->logo }}</td>
                    <td>{{ $team->nombre }}</td>
                    <td>
                        <a href="/admin/users/{{ $user->id }}" class="btn btn-primary">Ver</a>
                        <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-warning">Editar</a>
                        <a href="/admin/users/{{ $user->id }}/delete" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
