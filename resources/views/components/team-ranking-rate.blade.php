@php
use App\Models\Team;
@endphp
<div class=" shadow-md rounded-md overflow-hidden mx-auto mt-16" style="width: 90%;">
    <div class=" py-2 px-4 relative">
        <h2 class="text-xl font-semibold titular text-gray-800">{{ $title }}</h2>
        <div style="height: 2px; background-color: #e44445; width: 100%;"></div> <!-- Línea roja debajo del título -->
    </div>
    <ul class="divide-y divide-gray-300">
        @foreach ($teams as $team)
        <li class="flex items-center py-4 px-6 border-b border-gray-300 {{ $loop->first ? 'bg-cover bg-center relative' : '' }}" style="{{ $loop->first ? 'background-image: url('.$team->team_photo.'); height: 400px;' : '' }}"> <!-- Aumenta la altura aquí -->
            @if ($loop->first)
            <div class="flex-1 text-white" style="z-index: 10;"> <!-- Texto sobre la imagen de fondo para el primer elemento -->
                <h1 class="titular text-2xl font-bold">{{ $team->name }}</h1>
                <h1 class="titular text-2xl font-bold"> <!-- Cambia la clase aquí -->
                    @if ($team->{$attribute} > 0)
                        {{ round(Team::getTeamWins($team->id) / $team->{$attribute} * 100, 2) }}%
                    @else
                        N/A
                    @endif
                </h1>
            </div>
            @else
            <span class="text-gray-700 text-lg font-medium mr-4">
                {{ $loop->iteration }}
            </span>
            <img class="team-logo" src="{{ $team->logo }}"
                alt="{{ $team->name }} logo">
            <div class="flex-1">
                <h3 class="titular text-lg font-bold text-gray-800">{{ $team->name }}</h3>
                <p class="text-gray-600 text-xl font-bold text-center">
                    @if ($team->{$attribute} > 0)
                    {{ round(Team::getTeamWins($team->id) / $team->{$attribute} * 100, 2) }}%
                @else
                    N/A
                @endif
                </p>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>
