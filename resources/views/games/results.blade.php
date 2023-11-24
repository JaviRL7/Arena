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
<div>
    
    <form action="{{ route('comments.store', $game) }}" method="POST" class="space-y-4">
        @csrf
        <div class="form-group">
            <label for="body" class="block text-sm font-medium text-gray-700">Comentario:</label>
            <textarea class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="body" id="body" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="player_id" class="block text-sm font-medium text-gray-700">Jugador:</label>
            <select class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="player_id" id="player_id">
                <option value="">Ninguno</option>
                @foreach($players_red as $player)
                    <option value="{{ $player->id }}">{{ $player->nick }}</option>
                @endforeach
                @foreach($players_blue as $player)
                    <option value="{{ $player->id }}">{{ $player->nick }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="team_id" class="block text-sm font-medium text-gray-700">Equipo:</label>
            <select class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="team_id" id="team_id">
                <option value="">Ninguno</option>
                <option value="{{ $game->team_blue->id }}">{{ $game->team_blue->name}}</option>
                <option value="{{ $game->team_red->id }}">{{ $game->team_red->name }}</option>
            </select>
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Enviar</button>
    </form>

</div>
<div class="space-y-4">
    @foreach($game->comments as $comment)
        <div class="comment p-4 border border-gray-200 rounded">
            <p class="font-bold">{{ $comment->user->name }}</p>
            <p>{{ $comment->body }}</p>
            <form action="{{ route('comments.like', $comment) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded">Like</button>
            </form>
            <p class="mt-2">Likes: {{ $comment->likes }}</p>
            <p class="mt-2">Equipo: {{ optional($comment->team)->name }}</p>
            <p class="mt-2">Jugador: {{ optional($comment->player)->nick }}</p>
        </div>
    @endforeach
</div>
@endsection
