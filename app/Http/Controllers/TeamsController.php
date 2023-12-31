<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Role;
use App\Models\Competition;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('id')->get();
        $today = Carbon::now()->format('Y-m-d');

        foreach ($teams as $team) {
            $team->checkSubstitute($today);
        }

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
        $competitions = Competition::all();
        $players = Player::all();
        return view('admin.teams.edit', [
            'today' => $today,
            'players' => $players,
            'roles' => $roles,
            'competitions' => $competitions,
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
    public function add(Team $team)
    {
        $today = Carbon::now()->format('Y-m-d');
        $roles = Role::all();
        $players = Player::all();
        return view('admin.teams.add', [
            'today' => $today,
            'players' => $players,
            'roles' => $roles,
            'team' => $team
        ]);
    }
    public function substitute(Team $team)
    {
        $today = Carbon::now()->format('Y-m-d');
        $roles = Role::all();
        $players = $team->getPlayersWithSameRole();
        return view('admin.teams.substitute', [
            'today' => $today,
            'players' => $players,
            'roles' => $roles,
            'team' => $team
        ]);
    }
    public function updateSubstitute(Player $player)
    {
        // Cambiar el valor de substitute
        $player->update(['substitute' => !$player->substitute]);

        return redirect()->back()->with('success', 'Substitute status updated successfully.');
    }
    public function add_player(Request $request, Team $team)
    {
        $player = Player::find($request->player_id);

        DB::transaction(function () use ($player, $team, $request) {

            $previousPlayer = $team->Players()->where('role_id', $player->role_id)->first();
            if ($previousPlayer) {
                $previousPlayer->substitute = true;
                $previousPlayer->save();
            }
            $previousTeam = $player->currentTeam();

            if ($previousTeam) {
                $player->teams()->updateExistingPivot($previousTeam->id, ['end_date' => $request->start_date]);
            }

            $team->Players()->attach($player->id, [
                'start_date' => $request->start_date,
                'contract_expiration_date' => $request->contract_expiration_date,

            ]);
            $player->substitute = false;
            $player->save();
        });

        return redirect()->route('admin.teams.index');
    }
}
