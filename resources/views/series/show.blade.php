@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
    <style>
        .tabla {
            table-layout: fixed;
            width: 100%;
            font-size: 1.6em;
        }

        .tabla-contenedor {
            margin: 20px;
        }

        .tabla tr {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tabla td {
            margin: 30px 0;
        }

        .tabla td {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .owl-carousel img {
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <h1 class="titulos">Game data</h1>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">
                <div class="owl-carousel owl-theme owl-grande">

                    @foreach ($serie->games as $game)
                        @php
                            $team_blue = $game->team_blue;
                            $team_red = $game->team_red;
                            $date = $serie->date;
                            $players_blue = $game->team_blue->getPlayersDate($date);
                            $players_red = $game->team_red->getPlayersDate($date);
                        @endphp

                        <div class="item">
                            <div class="tabla-contenedor">
                                <table class="tabla">
                                    <tbody>
                                        @for ($i = 0; $i < max(count($players_blue), count($players_red)); $i++)
                                            <tr class="align-middle">
                                                @if (isset($players_blue[$i]))
                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            <img src="{{ asset($players_blue[$i]->photo) }}"
                                                                alt="{{ $players_blue[$i]->photo }}" class="img-fluid"
                                                                style="width: 100px !important;
                                                height: 100px !important;">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                                            {{ $players_blue[$i]->nick }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->kills }}
                                                            /
                                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->deaths }}
                                                            /
                                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            <img src="{{ asset($players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                                                alt="{{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                                                class="img-fluid"
                                                                style="width: 50px !important;
                                                height: 50px !important;">
                                                        </div>
                                                    </td>
                                                @endif
                                                <td style="font-family: mol">VS</td>
                                                @if (isset($players_red[$i]))
                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                                            <img src="{{ asset($players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                                                alt="{{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                                                class="img-fluid"
                                                                style="width: 50px !important;
                                                height: 50px !important;">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->kills }}
                                                            /
                                                            {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->deaths }}
                                                            /
                                                            {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                                            {{ $players_red[$i]->nick }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            style="width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                                            <img src="{{ asset($players_red[$i]->photo) }}"
                                                                alt="{{ $players_red[$i]->photo }}" class="img-fluid"
                                                                style="width: 100px !important;
                                                    height: 100px !important;">
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="ban-container">
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach(range(1, 5) as $ban)
                                            @if($game->{'ban'.$ban.'_blue'}()->exists())
                                                <img src="{{ asset($game->{'ban'.$ban.'_blue'}()->first()->square) }}" class="img-fluid ban-img">
                                            @else
                                                <p>No hay ban disponible</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        @foreach(range(1, 5) as $ban)
                                            @if($game->{'ban'.$ban.'_red'}()->exists())
                                                <img src="{{ asset($game->{'ban'.$ban.'_red'}()->first()->square) }}" class="img-fluid ban-img">
                                            @else
                                                <p>No hay ban disponible</p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            console.log("Documento listo");
            $(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                //autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });
        });
    </script>
@endsection
