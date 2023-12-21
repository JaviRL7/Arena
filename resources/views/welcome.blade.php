
@extends('layouts.plantilla')
@section('title', 'show games')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

@endsection
@section('content')

<div class="container">
    <div class="row">
      <div class="col-lg-6" style="height: 600px;">
        <img src="material/final.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 1">
      </div>
      <div class="col-lg-6">
        <div class="row h-50">
          <div class="col-lg-12" style="height: 300px;">
            <img src="material/hwei.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 2">
          </div>
        </div>
        <div class="row h-50">
          <div class="col-lg-12" style="height: 300px;">
            <img src="material/gumayusi.jpeg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

