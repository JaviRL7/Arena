@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')
<style>
.hover-zoom {
    transition: transform .2s;
}

.hover-zoom:hover {
    transform: scale(1.05);
}

a.text-decoration-none {
    color: inherit;
}
</style>

<div class="month-selector">
    @foreach ($seriesByMonth as $month => $seriesByDate)
        <button onclick="showMonth('{{ $month }}')">{{ $month }}</button>
    @endforeach
</div>

<div class="contenedor-calendar">
    <div class="my-table-container-calendar titular">
        @foreach ($seriesByMonth as $month => $seriesByDate)
            <table class="my-table-calendar" id="{{ $month }}" style="display: none;">
                <tbody>
                    @foreach ($seriesByDate as $date => $series)
                        <tr>
                            <td colspan="5">
                                <h2>{{ \Carbon\Carbon::parse($date)->format('l - j F') }}</h2>
                                <hr>
                            </td>
                        </tr>
                        @foreach ($series as $serie)
                            <tr class="game-calendar">
                                <td class="competition-logo">
                                    <div class="logo-and-time">
                                        <a href="{{ route('series.show', $serie) }}" class="text-decoration-none hover-zoom">
                                            <img class="team-logo-calendar" src="{{ $serie->competition->logo }}" alt="{{ $serie->competition->name }}">
                                            @if ($serie->hour)
                                                <h4 class="hora">{{ \Carbon\Carbon::parse($serie->hour)->format('H:i') }}</h4>
                                            @else
                                                <h5 class="titulo-sin-hora">No hour yet</h5>
                                            @endif
                                        </a>
                                    </div>
                                </td>
                                <td class="teams-calendar">
                                    <a href="{{ route('series.show', $serie) }}" class="text-decoration-none hover-zoom">
                                        <img class="team-logo-calendar" src="{{ $serie->team_1->logo }}" alt="{{ $serie->team_1->name }}">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('series.show', $serie) }}" class="text-decoration-none hover-zoom">
                                        <h1 class="titulo-vs">vs</h1>
                                    </a>
                                </td>
                                <td class="teams-calendar">
                                    <a href="{{ route('series.show', $serie) }}" class="text-decoration-none hover-zoom">
                                        <img class="team-logo-calendar" src="{{ $serie->team_2->logo }}" alt="{{ $serie->team_2->name }}">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('series.show', $serie) }}" class="text-decoration-none hover-zoom">
                                        <div class="serie-details titular">
                                            <p>{{ $serie->type }}</p>
                                            <p>{{ $serie->name }}</p>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</div>

<br>
<br>

<script>
window.onload = function() {
    showMonth('{{ now()->format('F Y') }}');
};

function showMonth(month) {
    var tables = document.getElementsByClassName('my-table-calendar');
    for (var i = 0; i < tables.length; i++) {
        tables[i].style.display = 'none';
    }
    var table = document.getElementById(month);
    if (table) {
        table.style.display = 'table';
    }
}
</script>

@endsection
