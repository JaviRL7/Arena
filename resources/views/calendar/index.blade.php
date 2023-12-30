@extends('layouts.plantilla')
@section('title', 'Teams index')
@section('content')

<h1 class="titulos-calendar">Date</h1>

<div class="my-table-container-calendar">
    <table class="my-table-calendar">
        <tbody>
            @foreach ($seriesByDate as $date => $series)
            <tr>
                <td colspan="3">
                    <h2>{{ date('Y-m-d', strtotime($date)) }}</h2>
                </td>
            </tr>
            @foreach ($series as $serie)
            <tr class="game-calendar">
                <td class="teams-calendar">
                    <img class="team-logo-calendar" src="{{ $serie->team_1->logo }}" alt="{{ $serie->team_1->name }}">
                </td>
                <td>
                    <h1>vs</h1>
                </td>
                <td class="teams-calendar">
                    <img class="team-logo-calendar" src="{{ $serie->team_2->logo }}" alt="{{ $serie->team_2->name }}">
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>

<br>
<br>

@endsection
