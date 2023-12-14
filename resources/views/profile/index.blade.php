
@extends('layouts.plantilla')
@section('title', 'profile')

@section('content')
    <h1>Esto es el perfil</h1>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <span>
                    {{ $user->name }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
            </div>
        </div>
    </div>


@endsection
