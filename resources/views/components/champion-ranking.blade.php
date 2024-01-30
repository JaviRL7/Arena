<div class="bg-white shadow-md rounded-md overflow-hidden mx-auto mt-16" style="width: 90%;">
    <div class="bg-gray-100 py-2 px-4 relative">
        <h2 class="text-xl font-semibold titular text-gray-800">{{ $title }}</h2>
        <div style="height: 2px; background-color: #e44445; width: 100%;"></div> <!-- Línea roja debajo del título -->
    </div>
    <ul class="divide-y divide-gray-300">
        @foreach ($champions as $champion)
        <li class="flex items-center py-4 px-6 border-b border-gray-300 {{ $loop->first ? 'bg-cover bg-center relative' : '' }}" style="{{ $loop->first ? 'background-image: url('.$champion->photo.'); color: white; height: 300px;' : '' }}">            @if ($loop->first)
            <div class="flex-1 text-white" style="z-index: 10;"> <!-- Texto sobre la imagen de fondo para el primer elemento -->

                <h3 class="titular text-lg font-bold">{{ $champion->name }}</h3>
                <p class="text-xl font-bold text-center">
                    {{ $champion->times_played }}</p>
            </div>
            @else
            <img class="w-16 h-16 rounded-full object-cover mr-4" src="{{ $champion->square }}" alt="{{ $champion->name }} photo">
            <div class="flex-1">
                <h3 class="titular text-lg font-bold text-gray-800">{{ $champion->name }}</h3>
                <p class="text-gray-600 text-xl font-bold text-center">
                    {{ $champion->times_played }}</p>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>
