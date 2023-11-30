<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Role;
use Illuminate\Validation\Rule;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('id')->get();
        $today = Carbon::now()->format('Y-m-d');

        if (auth()->check() && auth()->user()->admin) {
            return view('admin.teams.index', [
                'teams' => $teams, 'today' => $today,

            ]);
        } else {
            return view('pages.players', [
                'teams' => $teams,
            ]);
        }
    }
    public function edit(Team $team)
    {
        $today = Carbon::now()->format('Y-m-d');
        $roles = Role::all();
        $players = Player::all();
        return view('admin.teams.edit', [
            'today' => $today,
            'players' => $players,
            'roles' => $roles,
            'team' => $team
        ]);
    }

    public function update(Request $request, Team $team)
{
    $request->validate([
        'name' => ['required', 'string', Rule::unique('teams')->ignore($team->id)],
        'league' => ['nullable', 'string'],
        'country' => ['nullable', 'string'],
        'logo' => ['nullable', 'image', 'max:3000'],
    ]);

    $logo = $team->logo;

    $team->update($request->except('logo'));

    if ($request->hasFile('logo')) {
        $teamName = str_replace(' ', '_', $team->name); // Reemplaza los espacios en blanco con un guión bajo
        $logo = $teamName . '_logo' . '.' . $request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->move(public_path('teams_logo'), $logo);
        $team->logo = 'teams_logo/' . $logo;
    }

    foreach ($team->getPlayers() as $player) {
        $pivot = $player->teams()->where('team_id', $team->id)->first()->pivot;
        if ($pivot) {
            $pivot->start_date = $request->input("start_date_{$player->id}") ?? $pivot->start_date;
            $pivot->end_date = $request->input("end_date_{$player->id}") ?? $pivot->end_date;
            $pivot->save();
        }
    }

    $team->save();
    return redirect()->route('admin.teams.index');
}

}
