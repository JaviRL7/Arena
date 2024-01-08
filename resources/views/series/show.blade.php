@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
<style>

.tabla {
    table-layout: fixed;
    width: 100%; /* Asegúrate de que la tabla ocupa todo el ancho disponible */
}

.tabla img {
    width: 472px; /* Ajusta el ancho de las imágenes */
    height: 402px; /* Ajusta la altura de las imágenes */
}

.tabla-contenedor {
    margin: 20px; /* Ajusta el margen alrededor del contenedor a 20px */
}
.tabla tr {
    display: flex;
    justify-content: space-between;
    align-items: center; /* Alinea todos los elementos de la fila verticalmente */
}
.tabla td {
    margin: 30px 0; /* Ajusta el margen vertical de las celdas a 20px */
}
.tabla td {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<h1 class="titulos">Game data</h1>
<div class="row">
    <div class="col-md-12">

<div class="owl-carousel owl-theme">

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
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                        <img src="{{ asset($players_blue[$i]->photo) }}" alt="{{ $players_blue[$i]->photo }}"
                                        class="">
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                            {{ $players_blue[$i]->nick }}
                                        </div>
                                    </td>
                                    <td>
                                    <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                            {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->kills }} /
                                        {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->deaths }} /
                                        {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                        <img src="{{ asset($players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                        alt="{{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                        class="">
                                        </div>
                                    </td>
                                @endif
                                <td style="font-family: mol">VS</td>
                                @if (isset($players_red[$i]))
                                <td>
                                    <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                        <img src="{{ asset($players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                        alt="{{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                        class="">
                                    </div>
                                </td>

                                    <td>
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                        {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->kills }} /
                                        {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->deaths }} /
                                        {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                        </div>
                                    </td>

                                    <td>
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">
                                            {{ $players_red[$i]->nick }}
                                        </div>
                                        </td>
                                    <td>
                                        <div style="width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: flex; justify-content: center; align-items: center;">

                                        <img src="{{ asset($players_red[$i]->photo) }}" alt="{{ $players_red[$i]->photo }}"
                                            class="">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

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
