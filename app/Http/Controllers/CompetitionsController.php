<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use App\Models\Competition;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    public function show(Competition $competition, $year)
    {
        // Obtiene todas las series de la competición en el año especificado
        $series = Serie::where('competition_id', $competition->id)->whereYear('date', $year)->get();

        return view('competitions.show', compact('competition', 'year', 'series'));
    }
}
