@extends('layouts.plantilla')
@section('title', 'Edit players')
@section('content')
    <h1>Modificar Players</h1>
    @include('admin.form.edit', [
        'columns' => ['name', 'lastname1', 'nick', 'photo', 'country'],
    ])
@endsection
