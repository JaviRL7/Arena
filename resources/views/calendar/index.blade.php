@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

<div class="month-selector">
    @foreach ($seriesByMonth as $month => $series)
    <button onclick="showMonth('{{ $month }}')">{{ $month }}</button>
    @endforeach
</div>
<div style="height: 80vh; margin-top: 150px;">

<div class="my-table-container-calendar">
    @foreach ($seriesByMonth as $month => $series)
    <table class="my-table-calendar" id="{{ $month }}" style="display: none;">
        <tbody>
            @foreach ($series as $serie)
            <tr>
                <td colspan="5">
                    <h2>{{ \Carbon\Carbon::parse($serie->date)->format('l - j F') }}</h2>
                    <hr>
                </td>
            </tr>
            <tr class="game-calendar">
                <td class="competition-logo">
                    <img src="{{ $serie->competition->logo }}" alt="{{ $serie->competition->name }}">
                </td>
                <td class="teams-calendar">
                    <img class="team-logo-calendar" src="{{ $serie->team_1->logo }}" alt="{{ $serie->team_1->name }}">
                </td>
                <td>
                    <h1 class="titulo-vs">vs</h1>
                </td>
                <td class="teams-calendar">
                    <img class="team-logo-calendar" src="{{ $serie->team_2->logo }}" alt="{{ $serie->team_2->name }}">
                </td>
                <td>
                    <div class="serie-details">
                        <p>{{ $serie->type }}</p>
                        <p>{{ $serie->name }}</p>
                    </div>
                </td>
            </tr>
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
        table.style.display = 'table'; // Cambia 'block' por 'table'
    }
}

</script>

@endsection
