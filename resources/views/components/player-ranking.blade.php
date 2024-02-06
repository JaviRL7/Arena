<div class="bg-white shadow-md rounded-md overflow-hidden mx-auto mt-16" style="width: 90%;">
    <div class="bg-gray-100 py-2 px-4 relative">
        <h2 class="text-xl font-semibold titular text-gray-800">{{ $title }}</h2>
        <div style="height: 2px; background-color: #e44445; width: 100%;"></div> <!-- Línea roja debajo del título -->
    </div>
    <ul class="divide-y divide-gray-300">
        @foreach ($players as $player)
        <li class="flex items-center py-4 px-6 border-b border-gray-300 {{ $loop->first ? 'bg-cover bg-center relative' : '' }}" style="{{ $loop->first ? 'background-image: url('.$player->img.'); height: 400px;' : '' }}"> <!-- Aumenta la altura aquí -->
            @if ($loop->first)
            <div class="flex-1 text-white" style="z-index: 10;"> <!-- Texto sobre la imagen de fondo para el primer elemento -->
                <h1 class="titular text-2xl font-bold">{{ $player->nick }} - {{ $player->name }} {{ $player->lastname1 }}</h1>
                <h1 class="subtitular text-xl">{{ $player->{$attribute} }}</h1>
            </div>
            @else
            <span class="text-gray-700 text-lg font-medium mr-4">
                {{ $loop->iteration }}
            </span>
            <img class="w-16 h-16 rounded-full object-cover mr-4" src="{{ $player->photo }}"
                alt="{{ $player->nick }} photo">
            <div class="flex-1">
                <h3 class="titular text-lg font-bold text-gray-800">{{ $player->nick }}</h3>
                <h3 class="subtitular text-sm font-medium text-gray-500">{{ $player->name }}
                    {{ $player->lastname1 }}
                    @if ($player->lastname2)
                        {{ ' ' . $player->lastname2 }}
                    @endif
                </h3>
                <p class="text-gray-600 text-xl font-bold text-center">
                    {{ $player->{$attribute} }}</p>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>
