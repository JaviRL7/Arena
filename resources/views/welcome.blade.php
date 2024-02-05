@extends('layouts.plantilla')
@section('title', 'show games')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

@endsection
@section('content')

    <div class="container" style="">
        <br>
        <br>

        <div class="title-line">
            <h2>Worlds</h2>
            <h4 class="subtitulo">"Rate and analyze your favorite players' matches in Worlds 2023."</h4>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12" style="height: 600px;">
                <div class="image-container">
                    <a href="{{ route('series.show', ['serie' => 1]) }}">
                    <img src="material/final.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 1">
                    </a>
                    <div class="image-title">
                        <h2>Check out the World Championship final stats</h2>
                    </div>
                    <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                        #Games
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="row h-50">
                    <div class="col-lg-12 col-12" style="height: 300px;">
                        <div class="image-container">

                            <a href="{{ route('players.rankings')}}">
                                <img src="material/hwei.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 2">
                            </a>
                            <div class="image-title">
                                <h2>Champions with the best win rate</h2>
                            </div>
                            <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                                #Rankings
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-50">
                    <div class="col-lg-12 col-12" style="height: 300px;">
                        <div class="image-container">
                            <a href="{{ route('players.rankings')}}">
                                <img src="material/gumayusi.jpeg" class="img-fluid h-100 w-100 object-fit-cover"
                                    alt="Imagen 3">
                            </a>
                            <div class="image-title">
                                <h2> Who is the player with the best KDA?</h2>
                            </div>
                            <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                                #Rankings
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="title-line">
            <h2>Esportle</h2>
            <h5 class="subtitulo"> "A word game where you have to guess the name of a competitive League of Legends player from 5 clues and earn points." </h5>

        </div>
        <div class="row">
            <div class="col-12" style="height: 300px;">
                <div class="image-container">
                    <a href="{{ route('minigame.index')}}">
                        <img src="material/faker.png" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>
                    <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                        #Esportle
                    </div>
                    <div class="image-title">
                        <h2>  How well do you know the pro scene?</h2>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="title-line">
            <h2>Profile</h2>
            <h5 class="subtitulo"> "Engage with your sports community, customize your online presence, root for your star athletes, and proudly defend your team's legacy." </h5>

        </div>
        <div class="row">
            <div class="col-lg-6 col-12" style="height: 600px;">
                <div class="image-container">
                    <a href="ruta-de-la-imagen-1">
                        <img src="material/deft.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 1">
                    </a>
                    <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                        #Profile
                    </div>
                    <div class="image-title">
                        <h2>Start your Gunlim adventure today! Create your account</h2>
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
                            <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                                #Teams
                            </div>
                            <div class="image-title">
                                <h2>Stand up for your team.

                                </h2>
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
                            <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                                #Players
                            </div>
                            <div class="image-title">
                                <h2>Become a true fan of your favorite players.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="title-line">
            <h2>Calendar</h2>
            <h4 class="subtitulo">  "Never miss a match." </h4>

        </div>
        <div class="row">
            <div class="col-12" style="height: 600px;">
                <div class="image-container">
                    <a href="ruta-de-la-imagen-3">
                        <img src="material/calendar1.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>
                    <div style="position: absolute; top: 20px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:x-large;">
                        #Calendar
                    </div>
                    <div class="image-title">
                        <h2>Season 2024 Week 1</h2>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="title-line">
            <h2>Off season</h2>
            <h4 class="subtitulo">  "Keep up with the latest moves in the 2023/24 offseason."

            </h4>

        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>Europe</h2>
            </div>
            <div class="col-6" style="height: 300px; position: relative;">

                <div class="image-container">
                    <a href="{{ route('transfers.index', ['view' => 1]) }}">
                        <img src="material/LEC.jpg" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>
                </div>

                <!-- Añade tu etiqueta aquí -->
                <div style="position: absolute; top: 20px; right: 10px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:large;">
                    #Transfers
                </div>
            </div>


            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="{{ route('transfers.index', ['view' => 1]) }}">
                        <h1>The children of misfortune</h1>
                        <h4 style="color: red; font-size: small;">Offseason 2024 Winter Split</h4>
                        <p style="margin-top: 5%; color: darkgray;">
                            After the tough reality check of last year's Worlds, the LEC is entering a new season with many changes in hopes of improving its international results. <br><br>

                            Razork demonstrated that he was the light in the ruins, and Oscarinin's meteoric improvement is an example for the next promises. However, the tough blow of G2 Esports after failing again with a roster with so much talent leaves doubts about the European level.</p>
                        <h4 style=""></h4>Check out the LEC 2024 Offseason Here</h4>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>North America</h2>
            </div>
            <div class="col-6" style="height: 300px; position: relative;">
                <div class="image-container">
                    <a href="{{ route('transfers.index', ['view' => 5]) }}">
                        <img src="material/lcs.png" class="img-fluid h-auto w-100 " alt="Imagen 3">
                    </a>
                </div>
                <div style="position: absolute; top: 20px; right: 10px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:large;">
                    #Transfers
                </div>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="{{ route('transfers.index', ['view' => 5]) }}">
                        <h1>Hope at the end of the tunnel</h1>
                        <h4 style="color: red; font-size: small;">Offseason 2024 Winter Split</h4>
                        <p style="margin-top: 5%; color: darkgray;">
                            NRG's meteoric rise gives hope to a struggling region

                            NRG's stunning and meteoric rise in the past season, based on local players and team play, brings hope to a region that is not going through its best moments and sets the way forward.
                        </p>
                        <h4 style=""></h4>Check out the LCS 2024 Offseason Here</h4>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>South Korea</h2>
            </div>
            <div class="col-6" style="height: 300px; position: relative;">
                <div class="image-container">
                    <a href="{{ route('transfers.index', ['view' => 3]) }}">
                        <img src="material/lck.png" class="img-fluid h-100 w-100 object-fit-cover" alt="Imagen 3">
                    </a>
                </div>
                <div style="position: absolute; top: 20px; right: 10px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:large;">
                    #Transfers
                </div>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="{{ route('transfers.index', ['view' => 3]) }}">
                        <h1>When Faker's gone</h1>
                        <h4 style="color: red; font-size: small;">Offseason 2024 Winter Split</h4>
                        <p style="margin-top: 5%; color: darkgray;">
                            The LCK's failure seemed inevitable, but only one thing in this game has always been inevitable: Faker. Faker and his team, led by a stellar Keria, defeated all of the LPL teams and completed the feat. But what will happen when Faker retires? That doubt runs through the fear of a region always accustomed to reigning.
                           </p>
                        <h4 style=""></h4>Check out the LCK 2024 Offseason Here</h4>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="title-secundary">
                <h2>China</h2>
            </div>
            <div class="col-6" style="height: 300px; position: relative;">
                <div class="image-container">
                    <a href="{{ route('transfers.index', ['view' => 4]) }}">
                        <img src="material/lpl.png" class="img-fluid h-auto w-100" alt="Imagen 3">
                    </a>
                </div>
                <div style="position: absolute; top: 20px; right: 10px; background-color: #e44445; color: white; padding: 7px; font-family: mol; font-size:large;">
                    #Transfers
                </div>
            </div>
            <div class="col-6" style="height: 300px;">
                <div class="informacion">
                    <a href="{{ route('transfers.index', ['view' => 4]) }}">
                        <h1>The allocation of wealth and talent</h1>
                        <h4 style="color: red; font-size: small;">Offseason 2024 Winter Split</h4>
                        <p style="margin-top: 5%; color: darkgray;">
                            Having three of the most dominant teams could be a lesser success for the most powerful region. The LPL faces a season in which the norms of the game have changed. The salary cap will balance the regions, a clear handicap for the region that ruled through its economic power over the others. Will the LPL know how to win without super rosters?.</p>
                        <h4 style=""></h4>Check out the LPL 2024 Offseason Here</h4>
                    </a>
                </div>
            </div>
        </div>
        <x-cookie-notice />

        <br>
        </div>
        <br><br>
        <br>
@endsection
