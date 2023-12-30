@extends('layouts.plantilla')
@section('title', 'show games')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

@endsection
@section('content')

    <div class="container">
        <br>
        <br>
        <div class="title-line">
            <h2>Worlds</h2>
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
                                <img src="material/gumayusi.jpeg" class="img-fluid h-100 w-100 object-fit-cover"
                                    alt="Imagen 3">
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
                        <img src="material/faker.png" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
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
                        <img src="material/deft.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 1">
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
                                <img src="material/T1skins.jpg" class="img-fluid h-100 w-100 object-fit-cover"
                                    alt="Imagen 2">
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
                                <img src="material/Fnatic1.jpg" class="img-fluid h-100 w-100 object-fit-cover"
                                    alt="Imagen 3">
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
            <h2>Calendar</h2>
        </div>
        <div class="row">
            <div class="col-12" style="height: 600px;">
                <div class="image-container">
                    <a href="ruta-de-la-imagen-3">
                        <img src="material/calendar1.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>
                    <div class="image-title">
                        <h1> LEC CALENDAR WEEK 1</h1>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="title-line">
            <h2>Off season</h2>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>Europe</h2>
            </div>
            <div class="col-6" style="height: 300px;">

                <div class="image-container">
                    <a href="ruta-de-la-imagen-3">
                        <img src="material/LEC.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>

                </div>
            </div>

            <div class="col-6" style="height: 300px;">
              <div class="informacion">
                  <a href="ruta-de-la-imagen-3">
                      <h1>3 - 0</h1>
                  </a>
              </div>
          </div>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>North America</h2>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="image-container">
                    <a href="ruta-de-la-imagen-3">
                        <img src="material/lcs.png" class="img-fluid h-auto w-100 " alt="Imagen 3">
                    </a>

                </div>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="ruta-de-la-imagen-3">
                        <h1>Repasa la offseason de NA</h1>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>South Korea</h2>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="image-container">
                    <a href="ruta-de-la-imagen-3">
                        <img src="material/lck.png" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>
                </div>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="ruta-de-la-imagen-3">
                        <h1>Repasa la offseason de NA</h1>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>China</h2>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="image-container">
                    <a href="ruta-de-la-imagen-3">
                        <img src="material/lpl.png" class="img-fluid h-auto w-100" alt="Imagen 3">
                    </a>
                </div>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="ruta-de-la-imagen-3">
                        <h1>Repasa la offseason de NA</h1>
                    </a>
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
