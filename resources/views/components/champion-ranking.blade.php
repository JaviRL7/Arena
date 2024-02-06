<div class=" shadow-md rounded-md overflow-hidden mx-auto mt-16" style="width: 90%;">
    <div class=" py-2 px-4 relative">
        <h2 class="text-xl font-semibold titular text-gray-800">{{ $title }}</h2>
        <div style="height: 2px; background-color: #e44445; width: 100%;"></div> <!-- Línea roja debajo del título -->
    </div>
    <ul class="divide-y divide-gray-300">
        @foreach ($champions as $champion)
        <li class="flex items-center py-4 px-6 border-b border-gray-300 {{ $loop->first ? 'bg-cover bg-center relative' : '' }}" style="{{ $loop->first ? 'background-image: url('.$champion->photo.'); color: white; height: 400px;' : '' }}">
            @if ($loop->first)
                <div class="flex-1 text-white" style="z-index: 10;"> <!-- Texto sobre la imagen de fondo para el primer elemento -->
                    <h1 class="titular text-2xl font-bold">{{ $champion->name }}</h1>
                    <h1 class="subtitular text-xl">
                        Times played: {{ $champion->times_played }}</h1>
                </div>
            @else
            <img class="w-16 h-16 rounded-full object-cover mr-4" src="{{ $champion->square }}" alt="{{ $champion->name }} photo">
            <div class="flex-1">
                <h3 class="titular text-lg font-bold text-gray-800">{{ $champion->name }}</h3>
                <p class="text-gray-600 text-xl font-bold text-center">
                    Times played: {{ $champion->times_played }}</p>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>
