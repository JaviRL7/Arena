@extends('layouts.plantilla')
@section('title', 'show games')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

@endsection
@section('content')

<div class="container">
    <div class="title-line">
        <h2>Worlds 23</h2>
      </div>
    <div class="row">
      <div class="col-lg-6 col-12" style="height: 600px;">
        <div class="image-container">
          <a href="ruta-de-la-imagen-1">
            <img src="material/final.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 1">
          </a>
          <div class="image-title">
            <h1>Check out the World Championship final stats</h1>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="row h-50">
          <div class="col-lg-12 col-12" style="height: 300px;">
            <div class="image-container">
              <a href="ruta-de-la-imagen-2">
                <img src="material/hwei.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 2">
              </a>
              <div class="image-title">
                <h1>Champions with the best win rate</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="row h-50">
          <div class="col-lg-12 col-12" style="height: 300px;">
            <div class="image-container">
              <a href="ruta-de-la-imagen-3">
                <img src="material/gumayusi.jpeg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
              </a>
              <div class="image-title">
                <h1> Who is the player with the best KDA?</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="title-line">
        <h2>Who's the player ?</h2>
      </div>
    <div class="row">
        <div class="col-12" style="height: 300px;">
            <div class="image-container">
                <a href="ruta-de-la-imagen-3">
                  <img src="material/faker.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                </a>
                <div class="image-title">
                  <h1> Who is the player with the best KDA?</h1>
                </div>
              </div>
        </div>
    </div>
    <br>
    <div class="title-line">
        <h2>Profile</h2>
      </div>
    <div class="row">
      <div class="col-lg-6 col-12" style="height: 600px;">
        <div class="image-container">
          <a href="ruta-de-la-imagen-1">
            <img src="material/final.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 1">
          </a>
          <div class="image-title">
            <h1>Check out the World Championship final stats</h1>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="row h-50">
          <div class="col-lg-12 col-12" style="height: 300px;">
            <div class="image-container">
              <a href="ruta-de-la-imagen-2">
                <img src="material/hwei.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 2">
              </a>
              <div class="image-title">
                <h1>Champions with the best win rate</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="row h-50">
          <div class="col-lg-12 col-12" style="height: 300px;">
            <div class="image-container">
              <a href="ruta-de-la-imagen-3">
                <img src="material/gumayusi.jpeg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
              </a>
              <div class="image-title">
                <h1> Who is the player with the best KDA?</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </div>
@endsection
