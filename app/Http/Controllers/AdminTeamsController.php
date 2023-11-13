<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTeamsController extends Controller
{
    public function index(){
        $teams = AdminTeam::all();

        return view('admin.teams', ['teams' => $teams]);
    }

}
