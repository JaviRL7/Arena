<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Prediction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    public function store(Request $request)
{
    // Validar la solicitud
    $request->validate([
        'serie_id' => 'required|exists:series,id',
        'team_1_win' => 'required|boolean',
    ]);

    // Asegurarse de que el usuario no haya enviado ya una predicción para esta serie
    $existingPrediction = Prediction::where('user_id', Auth::id())
        ->where('serie_id', $request->serie_id)
        ->first();

    if ($existingPrediction) {
        // Si ya votó y el voto es diferente, actualiza el voto
        if ($existingPrediction->team_1_win != $request->team_1_win) {
            $existingPrediction->team_1_win = $request->team_1_win;
            $existingPrediction->save();
        } else {
            // Si votó por el mismo equipo, devuelve un mensaje sin cambios
            return response()->json([
                'message' => 'You have already voted for the same team.'
            ], 200);
        }
    } else {
        // Crear y guardar la nueva predicción si no existe
        $prediction = new Prediction();
        $prediction->user_id = Auth::id();
        $prediction->serie_id = $request->serie_id;
        $prediction->team_1_win = $request->team_1_win;
        $prediction->save();
    }

    // Obtener el total de predicciones para la serie
    $serie = Serie::with('predictions')->find($request->serie_id);
    $totalPredictions = $serie->predictions->count();
    $team1Wins = $serie->predictions->where('team_1_win', true)->count();

    if ($totalPredictions > 0) {
        $percentageTeam1 = ($team1Wins / $totalPredictions) * 100;
        $percentageTeam2 = 100 - $percentageTeam1;
    } else {
        $percentageTeam1 = $percentageTeam2 = 50; // Si no hay predicciones, mostrar 50% para cada equipo
    }

    // Devolver los porcentajes en formato JSON
    return response()->json([
        'percentageTeam1' => $percentageTeam1,
        'percentageTeam2' => $percentageTeam2,
    ]);
}
}
