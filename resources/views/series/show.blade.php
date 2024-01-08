@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
<h1 class="titulos">Game data</h1>
<h1>{{$serie->team_1->name}}</h1>
<div class="owl-carousel owl-theme">
    @foreach ($serie->games as $game)
        @php
            $team_blue = $game->team_blue;
            $team_red = $game->team_red;
            $players_blue = $game->players->where('team_id', $team_blue->id);
            $players_red = $game->players->where('team_id', $team_red->id);
        @endphp
        <div class="item">
            <div class="my-table-container">
                <table class="my-table">
                    <tbody>
                        @for ($i = 0; $i < max(count($players_blue), count($players_red)); $i++)
                            <tr class="align-middle">
                                @if (isset($players_blue[$i]))
                                    <td>
                                        <img src="{{ asset($players_blue[$i]->photo) }}" alt="{{ $players_blue[$i]->photo }}"
                                        class="w-36 h-36 object-cover rounded-full">
                                    </td>
                                    <td>{{ $players_blue[$i]->nick }}</td>
                                    <td>{{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->kills }} /
                                        {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->deaths }} /
                                        {{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                        alt="{{ $players_blue[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                        class="w-14 h-14 object-cover rounded-full">
                                    </td>
                                @endif
                                <td>VS</td>
                                @if (isset($players_red[$i]))
                                    <td>{{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->kills }} /
                                        {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->deaths }} /
                                        {{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->assists }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                            alt="{{ $players_red[$i]->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                            class="w-14 h-14 object-cover rounded-full">
                                    </td>
                                    <td>{{ $players_red[$i]->nick }}</td>
                                    <td>
                                        <img src="{{ asset($players_red[$i]->photo) }}" alt="{{ $players_red[$i]->photo }}"
                                            class="w-36 h-36 object-cover rounded-full">
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
@endsection
