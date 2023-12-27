<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Competition;
use App\Models\Team;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::all();
        return view('series.index', compact('series'));
    }
    public function create()
    {
        $competitions = Competition::all();
        $teams = Team::all();
        return view('admin.series.create', ['competitions' => $competitions, 'teams' => $teams ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'team1' => 'required',
        'team2' => 'required',
        'type' => 'required',
        'competition_id' => 'required',
        'date' => 'required',
    ]);

    $serie = new Serie;
    $serie->name = $request->name;
    $serie->team_1_id = $request->team1;
    $serie->team_2_id = $request->team2;
    $serie->type = $request->type;
    $serie->date = $request->date;
    $serie->competition_id = $request->competition_id; // Cambio aquí
    $serie->save();

    return redirect()->route('admin.games.index')->with('success', 'Serie created successfully.');
}

}
