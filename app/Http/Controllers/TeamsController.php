<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;
use App\Models\Role;
use App\Models\Serie;
use App\Models\Champion;
use App\Models\Competition;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use ColorThief\ColorThief;

class TeamsController extends Controller
{

    public function index_show()
    {
        $teams = Team::all();
        $competitions = Competition::all();

        return view('equipos.index', [
            'teams' => $teams,
            'competitions' => $competitions,
        ]);
    }
    public function getPlayersYear($teamId, $year)
    {
        $team = Team::find($teamId);
        $players = $team->getPlayersByYear($year);
        return response()->json($players);
    }






    public function profile($id)
    {
        $series = Serie::all();
        $team = Team::find($id);
        $years = range(\Carbon\Carbon::parse($team->players()->min('start_date'))->year, now()->year);

        // Extrae el color predominante del logo del equipo
        $dominantColor = ColorThief::getColor(public_path($team->logo));
        $rgbColor = 'rgb(' . $dominantColor[0] . ',' . $dominantColor[1] . ',' . $dominantColor[2] . ')';

        $playersByYear = [];
        $championData = [];

        foreach ($years as $year) {
            $playersByYear[$year] = $team->getPlayersByYear($year);
        }

        // Obtén solo los campeones con los que ha jugado el equipo
        $playerIds = $team->players()->pluck('id');
        $champions = DB::table('clasifications')
                        ->whereIn('player_id', $playerIds)
                        ->join('games', 'clasifications.game_id', '=', 'games.id')
                        ->join('series', 'games.serie_id', '=', 'series.id')
                        ->join('champions', 'clasifications.champion_id', '=', 'champions.id')
                        ->select('champions.*', 'series.date as date')
                        ->get()
                        ->unique('id');

        // Calcula los porcentajes de victoria y derrota para cada campeón
        foreach ($champions as $champion) {
            $championData[$champion->id] = [
                'name' => $champion->name,
                'image' => $champion->square, // Usa el atributo 'square' para la imagen
                'stats' => $team->getChampionWinLoss($champion->id),
            ];
        }
        return view('equipos.profile', [
            'team' => $team,
            'rgbColor' => $rgbColor,
            'years' => $years,
            'series' => $series,
            'playersByYear' => $playersByYear,
            'championData' => $championData,
        ]);
    }



















    public function index()
    {
        if (!auth()->check() || !auth()->user()->admin) {
            // Redirige a los usuarios no administradores a donde quieras, por ejemplo, a la página de inicio
            return redirect('/');
        }

        $teams = Team::orderBy('id')->get();
        $today = Carbon::now()->format('Y-m-d');
        $competitions = Competition::all();

        foreach ($teams as $team) {
            $team->checkSubstitute($today);
        }

        return view('admin.teams.index', [
            'teams' => $teams, 'today' => $today, 'competitions' => $competitions,
        ]);
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
        try {
            DB::transaction(function () use ($request, $team) {
                $player = Player::find($request->player_id);

                $previousPlayers = $team->getPlayersDate($request->start_date);

                $previousPlayer = $previousPlayers->where('role_id', $player->role_id)->first();
                if ($previousPlayer) {
                    $team->players()->updateExistingPivot($previousPlayer->id, ['substitute' => true]);
                }

                $previousTeam = $player->getLastTeam();

                if ($previousTeam) {
                    $previousContract = $player->teams()->where('team_id', $previousTeam->id)->first()->pivot;
                    $end_date = $previousContract->contract_expiration_date < $request->start_date ? $previousContract->contract_expiration_date : $request->start_date;
                    $player->teams()->updateExistingPivot($previousTeam->id, ['end_date' => $end_date]);
                }

                $contract_expiration_date = $request->contract_expiration_date;

                if (strlen($contract_expiration_date) == 4) {
                    $contract_expiration_date = $contract_expiration_date . '-12-31';
                } elseif (empty($contract_expiration_date)) {
                    $contract_expiration_date = date('Y') . '-12-31';
                }

                // Comprobar si ya existe un registro con el mismo team_id y player_id
                $existingRecord = DB::table('player_team')
                    ->where('player_id', $player->id)
                    ->where('team_id', $team->id)
                    ->where(function ($query) use ($request, $contract_expiration_date) {
                        $query->whereBetween('start_date', [$request->start_date, $contract_expiration_date])
                            ->orWhereBetween('end_date', [$request->start_date, $contract_expiration_date]);
                    })
                    ->first();

                if ($existingRecord) {
                    // Si existe un registro, lanzar una excepción
                    throw new \Exception('A record with the same dates already exists.');
                }

                $team->players()->attach($player->id, [
                    'start_date' => $request->start_date,
                    'contract_expiration_date' => $contract_expiration_date,
                    'substitute' => false
                ]);

                if ($previousTeam) {
                    $inserted = DB::table('transfers')->insert([
                        'player_id' => $player->id,
                        'team_from_id' => $previousTeam->id,
                        'team_to_id' => $team->id,
                        'date' => date('Y-m-d'),
                    ]);

                    if (!$inserted) {
                        dd('Failed to insert into transfers table');
                    }
                }
            });
        } catch (\Exception $e) {
            // Redirigir al usuario a la página anterior con un mensaje de error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.teams.index');
    }

    public function renewContract(Request $request, $teamId, $playerId)
    {
        $team = Team::find($teamId);
        $player_team = $team->players()->where('player_id', $playerId)->first()->pivot;

        $new_date = $request->input('new_date');
        if (!$new_date) {
            $new_year = $request->input('new_year');
            $new_date = $new_year . '-12-31';
        }

        $player_team->contract_expiration_date = $new_date;
        $player_team->save();

        return redirect()->route('admin.teams.edit', ['team' => $teamId])->with('success', 'Contrato renovado exitosamente');
    }
    public function setEndDate(Request $request, $teamId, $playerId)
    {
        $team = Team::find($teamId);
        $player_team = $team->players()->where('player_id', $playerId)->first()->pivot;

        $new_end_date = $request->input('new_end_date');
        if (!$new_end_date) {
            $new_end_date = date('Y-m-d');
        }

        $player_team->end_date = $new_end_date;
        $player_team->save();

        return redirect()->route('admin.teams.edit', ['team' => $teamId])->with('success', 'End date updated successfully!');
    }
    public function correctStartDate(Request $request, $teamId, $playerId)
    {
        $team = Team::find($teamId);
        $player_team = $team->players()->where('player_id', $playerId)->first()->pivot;

        $correct_start_date = $request->input('correct_start_date');

        $player_team->start_date = $correct_start_date;
        $player_team->save();

        return redirect()->route('admin.teams.edit', ['team' => $teamId])->with('success', 'Start date corrected successfully!');
    }





    public function updateTitular(Request $request, Team $team)
    {
        DB::transaction(function () use ($request, $team) {
            foreach ($request->titular as $role_id => $player_id) {
                // Encuentra al jugador que se ha seleccionado como titular
                $titular = $team->players()->where('player_team.player_id', $player_id)->first();

                // Comprueba si $titular es un objeto antes de intentar asignarle propiedades
                if (is_object($titular)) {
                    $team->players()->updateExistingPivot($titular->id, ['substitute' => false]);
                }

                // Encuentra a los jugadores suplentes en el mismo rol
                $suplentes = $team->players()->where('role_id', $role_id)->where('player_team.player_id', '!=', $player_id)->get();

                // Actualiza a los jugadores suplentes
                foreach ($suplentes as $suplente) {
                    // Comprueba si $suplente es un objeto antes de intentar asignarle propiedades
                    if (is_object($suplente)) {
                        $team->players()->updateExistingPivot($suplente->id, ['substitute' => true]);
                    }
                }
            }
        });

        return redirect()->route('admin.teams.index');
    }

    public function deleteAppearance(Request $request, Team $team, Player $player)
    {
        $team->players()->detach($player->id);

        return redirect()->route('admin.teams.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'league_id' => ['required', 'integer'],
            'country' => ['nullable', 'string'],
            'team_photo' => ['nullable', 'image', 'max:3000'],
            'logo' => ['nullable', 'image', 'max:3000']
        ]);

        $team = new Team;
        $team->fill($request->all());

        if ($request->hasFile('team_photo')) {
            $team_photo = 'teams/' . $team->name . '.' . $request->file('team_photo')->getClientOriginalExtension();
            $request->file('team_photo')->move(public_path('teams'), $team_photo);
            $team->team_photo = $team_photo;
        }

        if ($request->hasFile('logo')) {
            $logo = 'teams_logo/' . $team->name . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('teams_logo'), $logo);
            $team->logo = $logo;
        }

        $team->save();

        return redirect()->route('admin.teams.index')->with('success', 'Se ha creado el equipo con éxito.');
    }

public function create()
{
    $competitions = Competition::all();

    return view('admin.teams.create', ['competitions' => $competitions]);
}
public function destroy(Team $team)
{
    // Elimina el equipo
    $team->delete();

    // Redirige al usuario a la página de índice con un mensaje de éxito
    return redirect()->route('admin.teams.index')->with('success', 'Se ha eliminado el equipo con éxito.');
}
}
