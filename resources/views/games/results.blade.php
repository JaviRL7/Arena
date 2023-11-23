@extends('layouts.plantilla')
@section('title', 'result games')

@section('content')
    <div class="flex justify-between">
        <div class="flex justify-between">
            <!-- Tabla 1 -->
            <table class="table-auto  mr-5">
            </thead>
            <tbody>
                @foreach ($players_blue as $player)
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                <form action="{{ route('games.store') }}" method="POST" class="bg-white-800 text-black p-6 rounded-md">
                                    @csrf
                                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                                    <input type="hidden" name="player_id" value="{{ $player->id }}">
                                    <select name="nota" class="form-select mt-1 block w-full rounded-lg">
                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="bg-gray-700 text-white p-2 rounded-md mt-4">Enviar</button>
                                </form>
                            </div>
                        </th>
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset($player->photo) }}"
                                    alt="{{ $player->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                                <img src="{{ asset('roles_icons/' . strtoupper($player->role) . '.png') }}" alt="{{ $player->role }}" class="w-auto h-12">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $player->nick }}<br>
                                <span
                                    class="text-gray-500">{{ $player->name }}
                                    {{ $player->lastname1 }}
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">
                                    <img
                                        src="{{ asset($player->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                        alt="{{ $player->games->first()->pivot->champion->name }}"
                                        class="w-16 h-16 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">
                                {{ $player->games->where('id', $game->id)->first()->pivot->kills }}/
                                {{ $player->games->where('id', $game->id)->first()->pivot->deaths }}/
                                {{ $player->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                        <th>
                            <div class="mx-4 w-28 text-2xl font-extrabold text-white bg-blue-500 border-2 border-blue-500 rounded-md p-2">
                                {{ optional(optional($player->scoresGames->where('id', $game->id)->first())->pivot)->note ?? ' - ' }}
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Tabla intermedia -->
        <table class="table-auto  mr-5">
            </thead>
                <tbody>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                    <img
                                        src="/roles_icons/TOP.png"
                                        alt="icono"
                                        class="w-16 h-16">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                    <img
                                        src="/roles_icons/Jungler.png"
                                        alt="icono"
                                        class="w-16 h-16">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                    <img
                                        src="/roles_icons/MID.png"
                                        alt="icono"
                                        class="w-16 h-16">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                    <img
                                        src="/roles_icons/ADC.png"
                                        alt="icono"
                                        class="w-16 h-16">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                    <img
                                        src="/roles_icons/Support.png"
                                        alt="icono"
                                        class="w-16 h-16">
                            </div>
                        </th>
                    </tr>
                </tbody>
        </table>
        <!-- Tabla 2 -->
        <table class="table-auto  mr-5">
        </thead>
        <tbody>
            @foreach ($players_red as $player)
                <tr class="align-middle">
                    <th>
                        <div class="mx-4 w-28 text-2xl font-extrabold text-white bg-red-500 border-2 border-red-500 rounded-md p-2">
                            {{ optional(optional($player->scoresGames->where('id', $game->id)->first())->pivot)->note ?? ' - ' }}
                        </div>
                    </th>
                    <th>
                        <div class="mx-4">
                            {{ $player->games->where('id', $game->id)->first()->pivot->kills }}/
                            {{ $player->games->where('id', $game->id)->first()->pivot->deaths }}/
                            {{ $player->games->where('id', $game->id)->first()->pivot->assists }}
                        </div>
                    </th>
                    <th>
                        <div class="mx-4">
                                <img
                                    src="{{ asset($player->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $player->games->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full">
                        </div>
                    </th>
                    <th>
                        <div class="mx-4">{{ $player->nick }}<br>
                            <span
                                class="text-gray-500">{{ $player->name }}
                                {{ $player->lastname1 }}
                            </span>
                        </div>
                    </th>
                    <th>
                        <div class="flex items-center">
                            <img src="{{ asset($player->photo) }}"
                                alt="{{ $player->photo }}"
                                class="w-36 h-36 object-cover rounded-full">
                            <img src="{{ asset('roles_icons/' . strtoupper($player->role) . '.png') }}" alt="{{ $player->role }}" class="w-auto h-12">
                        </div>
                    </th>
                    <th>
                        <div class="mx-4">
                            <form action="{{ route('games.store') }}" method="POST" class="bg-white-800 text-black p-6 rounded-md">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <input type="hidden" name="player_id" value="{{ $player->id }}">
                                <select name="nota" class="form-select mt-1 block w-full rounded-lg">
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button type="submit" class="bg-gray-700 text-white p-2 rounded-md mt-4">Enviar</button>
                            </form>
                        </div>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
