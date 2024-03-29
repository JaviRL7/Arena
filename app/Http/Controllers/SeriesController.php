<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Competition;
use App\Models\Team;
use App\Models\Prediction;
use App\Models\Score;
use App\Models\User;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function destroy(Serie $serie)
    {
        $serie->delete();

        return back()->with('success', 'Series deleted successfully');
    }


    public function getAvailableMapNumbers($serieId) {
        $serie = Serie::with('games')->find($serieId);  // Asegúrate de tener una relación games en el modelo Serie
        $existingNumbers = $serie->games->pluck('number')->all(); // Obtén los números de mapa existentes

        $maxMaps = 1; // Por defecto para bo1
        if ($serie->type == 'bo3') {
            $maxMaps = 3;
        } elseif ($serie->type == 'bo5') {
            $maxMaps = 5;
        }

        $availableNumbers = [];
        for ($i = 1; $i <= $maxMaps; $i++) {
            if (!in_array($i, $existingNumbers)) {
                $availableNumbers[] = $i;  // Agrega el número si no está en la lista de existentes
            }
        }

        return $availableNumbers;
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
    $user = Auth::user();

    $scores = Score::whereHas('game', function ($query) use ($serie) {

        $query->where('serie_id', $serie->id);
    })->with(['user', 'player', 'game', 'game.champion'])->latest()->get();

    // Asegúrate de que la relación 'comments' esté definida en el modelo Serie y de obtener los comentarios
    $comments = $serie->comments()->with('user')->latest()->get();
    $scores_games = Score::whereHas('game', function ($query) use ($serie) {
        $query->where('serie_id', $serie->id);
    })->get();

    // Crea un array para almacenar las revisiones
    $reviews = [];

    // Itera sobre los Scores y añade cada revisión al array
    foreach ($scores_games as $score) {
        $reviews[$score->game_id][$score->player_id][$score->user_id] = $score->review;
    }


    // Fusionar las colecciones y ordenarlas por fecha de creación
    $activities = $scores->concat($comments)->sortByDesc('created_at')->take(5);
    // Fusionar las colecciones y ordenarlas por fecha de creación

    $teams = Team::all();

    // Obtén la predicción existente, si la hay
    $existingPrediction = Prediction::where('serie_id', $serie->id)
        ->where('user_id', $user->id)
        ->first();

    $hasVoted = $existingPrediction !== null;
    $votedForTeam = null;
    if ($hasVoted) {
        $votedForTeam = $existingPrediction->team_1_win ? $serie->team_1->name : $serie->team_2->name;
    }

    // Obtener el total de predicciones para la serie
    $totalPredictions = $serie->predictions->count();
    $team1Wins = $serie->predictions->where('team_1_win', true)->count();

    if ($totalPredictions > 0) {
        $percentageTeam1 = ($team1Wins / $totalPredictions) * 100;
        $percentageTeam2 = 100 - $percentageTeam1;
    } else {
        $percentageTeam1 = $percentageTeam2 = 50; // Valores por defecto si no hay predicciones
    }



    return view('series.show', [
        'serie' => $serie,
        'teams' => $teams,
        'activities' => $activities,
        'hasVoted' => $hasVoted,
        'votedForTeam' => $votedForTeam,
        'percentageTeam1' => $percentageTeam1,
        'percentageTeam2' => $percentageTeam2,
        'reviews' => $reviews,
    ]);
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
