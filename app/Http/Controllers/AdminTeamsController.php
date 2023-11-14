<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;
use Illuminate\Http\Request;

class AdminTeamsController extends Controller
{
    public function index()
    {
        $competition = Competition::where('name', 'LEC')->first();

        $teams = Team::where('competition_id', $competition->id)->get();

        return view('admin.teams', compact('teams'));
    }
}
