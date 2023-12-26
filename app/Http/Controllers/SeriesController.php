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
            'team_1_id' => 'required',
            'team_2_id' => 'required',
            'type' => 'required',
            'date' => 'required',
            'competition_id' => 'required',
        ]);

        $serie = new Serie;
        $serie->name = $request->name;
        $serie->team_1_id = $request->team_1_id;
        $serie->team_2_id = $request->team_2_id;
        $serie->type = $request->type;
        $serie->date = $request->date;
        $serie->competition_id = $request->competition_id;
        $serie->save();

        return redirect()->route('admin.series.index')->with('success', 'Serie created successfully.');
    }
}
