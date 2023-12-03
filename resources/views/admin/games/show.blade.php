@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
    <div class="table-responsive">
        <table class="table-striped table">
            <tbody>
                @foreach ($players_blue as $player_blue)
                    <tr class="align-middle">
                        <th>
                            <div class="">
                        <th>
                            <img src="{{ asset($player_blue->photo) }}" alt="{{ $player_blue->photo }}"
                                class="w-36 h-36 object-cover rounded-full">
                        </th>
                        <th>
                            <div class="">{{ $player_blue->nick }}<br>
                                <span class="text-gray-500">{{ $player_blue->name }}
                                    {{ $player_blue->lastname1 }}
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="">
                                <img src="{{ asset($player_blue->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $player_blue->games->first()->pivot->champion->name }}"
                                    class="w-14 h-14 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="">
                                {{ $player_blue->games->where('id', $game->id)->first()->pivot->kills }}/
                                {{ $player_blue->games->where('id', $game->id)->first()->pivot->deaths }}/
                                {{ $player_blue->games->where('id', $game->id)->first()->pivot->assists }}
                                <a href="{{ route('admin.games.edit_result', ['game' => $game, 'player' => $player_blue]) }}" class="text-blue">Edit Result</a>

                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table-striped table">
            <tbody>
                @foreach ($players_red as $player_red)
                    <tr class="align-middle">
                        <th>
                            <img src="{{ asset($player_red->photo) }}" alt="{{ $player_red->photo }}"
                                class="w-36 h-36 object-cover rounded-full">
                        </th>
                        <th>
                            <div class="">{{ $player_red->nick }}<br>
                                <span class="text-gray-500">{{ $player_red->name }}
                                    {{ $player_red->lastname1 }}
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="">
                                <img src="{{ asset($player_red->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $player_red->games->first()->pivot->champion->name }}"
                                    class="w-14 h-14 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="">
                                {{ $player_red->games->where('id', $game->id)->first()->pivot->kills }}/
                                {{ $player_red->games->where('id', $game->id)->first()->pivot->deaths }}/
                                {{ $player_red->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
