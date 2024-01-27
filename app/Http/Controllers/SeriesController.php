<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Competition;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        // Obtiene todos los años en los que se jugaron series
        $years = Serie::selectRaw('EXTRACT(YEAR FROM date) as year')->distinct()->get();

        $competitionsByYear = [];
        foreach ($years as $year) {
            // Obtiene las competiciones que tienen series en el año especificado
            $competitions = Competition::whereHas('series', function ($query) use ($year) {
                $query->whereYear('date', $year->year);
            })->get();

            $competitionsByYear[$year->year] = $competitions;
        }

        return view('series.index', compact('competitionsByYear'));
    }




    public function show_year(Competition $competition, $year)
    {
        // Obtiene todas las series de la competición en el año especificado
        $series = Serie::where('competition_id', $competition->id)->whereYear('date', $year)->get();

        return view('series.show_year', compact('competition', 'year', 'series'));
    }










    public function getPlayerNames(Serie $serie, Request $request)
    {
        $date = $serie->date;
        $players1 = $serie->team_1->getPlayersDate($date);
        $players2 = $serie->team_2->getPlayersDate($date);
        $playerNames = $players1->concat($players2)->pluck('nick');

        return response()->json($playerNames);
    }
    public function getTeamNames(Serie $serie, Request $request)
{
    $teamNames = collect([$serie->team_1->name, $serie->team_2->name]);

    return response()->json($teamNames);
}
    public function create()
    {
        $competitions = Competition::all();
        $teams = Team::all();
        return view('admin.series.create', ['competitions' => $competitions, 'teams' => $teams]);
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
    public function show(Serie $serie)
    {
        $teams = Team::all();
        $competitions = Competition::all();

        return view('admin.series.show', compact('serie', 'teams', 'competitions'));
    }
    public function show_2(Serie $serie)
    {
        $activities = $serie->recentActivities();

        $games = $serie->games;
        $teams = Team::all();

        return view('series.show', compact('serie', 'games','teams','activities'));
    }

    public function update(Request $request, Serie $serie)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'team_1_id' => 'required',
        'team_2_id' => 'required',
        'type' => 'required',
        'date' => 'required',
        'hour' => 'required', // Añade esto
        'competition_id' => 'required',
    ]);

    $serie->name = $validatedData['name'];
    $serie->team_1_id = $validatedData['team_1_id'];
    $serie->team_2_id = $validatedData['team_2_id'];
    $serie->type = $validatedData['type'];
    $serie->date = $validatedData['date'];
    $serie->hour = $validatedData['hour']; // Añade esto
    $serie->competition_id = $validatedData['competition_id'];

    $serie->save();

    return redirect()->route('admin.games.index')->with('success', 'Serie updated successfully');
}
    public function calendar()
    {
        $series = Serie::where('date', '>=', now())->orderBy('date')->get();

        $seriesByMonth = $series->groupBy(function ($serie) {
            $date = \Carbon\Carbon::parse($serie->date);
            return $date->format('F Y');
        });

        foreach ($seriesByMonth as $month => $series) {
            $seriesByMonth[$month] = $series->groupBy(function ($serie) {
                $date = \Carbon\Carbon::parse($serie->date);
                return $date->format('Y-m-d');
            });
        }

        return view('calendar.index', ['seriesByMonth' => $seriesByMonth]);
    }


}
