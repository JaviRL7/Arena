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

        .conte {
            display: flex;
            justify-content: space-between;
        }

        .serie-show-table {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .row {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .cell {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
        }
        .team-images {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.team-img {
    width: 600px; /* Ajusta el tamaño según tus necesidades */
    height: auto; /* Ajusta el tamaño según tus necesidades */
}

.vs-img {
    position: absolute;
    width: 180px; /* Ajusta el tamaño según tus necesidades */
    height: auto; /* Ajusta el tamaño según tus necesidades */
}
    </style>
    <h1>
        @php
            $players = $serie->team_1->getPlayersDate($serie->date);
        @endphp

        @foreach ($players as $player)
            {{ $player->nick }}
        @endforeach
    </h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="team-images">
                    <img src="{{ asset($serie->team_1->team_photo) }}" class="img-fluid team-img">
                    <img src="{{ asset('recursos/VS.png') }}" class="img-fluid vs-img">
                    <img src="{{ asset($serie->team_2->team_photo) }}" class="img-fluid team-img">
                </div>
                <div class="serie">
                    <div class="team">
                        <img src="{{ asset($serie->team_1->logo) }}" alt="{{ $serie->team_1->name }}">
                    </div>
                    <div class="result">
                        <h2>{{ $serie->getResultSerie() }}</h2>
                    </div>
                    <div class="team">
                        <img src="{{ asset($serie->team_2->logo) }}" alt="{{ $serie->team_2->name }}">
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-8">
                <h1 class="titulo" style="text-align-last: center">Game Data</h1>

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
                                <h1 class="titulo" style="text-align-last: center">Ban phase</h1>
                                @if ($game->{'ban1_blue'}()->exists())
                                    <div class="serie-show-table">
                                        <!-- Primera fila -->
                                        <div class="row">
                                            @foreach (range(1, 3) as $ban)
                                                @if ($game->{'ban' . $ban . '_blue'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_blue'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                                @if ($game->{'ban' . $ban . '_red'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_red'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <!-- Segunda fila -->
                                        <div class="row">
                                            @foreach (range(4, 5) as $ban)
                                                @if ($game->{'ban' . $ban . '_blue'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_blue'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                                @if ($game->{'ban' . $ban . '_red'}()->exists())
                                                    <div class="cell">
                                                        <img src="{{ asset($game->{'ban' . $ban . '_red'}()->first()->square) }}"
                                                            style="width: 50px!important; height:50px !important"
                                                            class="img-fluid ban-img">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>



                        </div>
                    @endforeach

                </div>

            </div>
            <div class="col-md-4">
                <h1 class="titulo">Users:</h1>
            </div>









        </div>
        <div class="row">
            <div class="col-md-12">
                <div>

                </div>
                <h1 class="titulo">Comments:</h1>
                <div class="card-footer py-3 border-0" style="background-color: #ffffff; margin-left: 100px">
                    <div class="d-flex flex-start w-100">
                        <img class="user-photo"
                            src="{{ asset(Auth::user()->user_photo) }}" alt="avatar"/>
                        <div class="form-outline w-50"> <!-- Cambiado a ocupar el 50% del ancho -->
                            <form action="{{ route('comments.store', $game) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="form-group" >
                                    <textarea class="form-control" name="body" id="body" rows="4" style="background: #fffbfb;"></textarea>
                                    <label class="form-labe" for="body"></label>
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancelar</button>
                                    <input type="hidden" id="serie" value="{{ $serie->id }}">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    var tribute;
    var serie = document.getElementById('serie').value;

$.getJSON("/series/" + serie + "/getPlayerNames", function(data) {
    var players = data.map(function(player) {
        return { key: player, value: player };
    });

    tribute = new Tribute({
        values: players
    });

    tribute.attach(document.getElementById('body'));
});
</script>
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
