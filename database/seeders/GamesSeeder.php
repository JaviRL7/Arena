<?php

namespace Database\Seeders;
use App\Models\Game;
use App\Models\Player;
use App\Models\Champion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $game1 = Game::create([
            'team_blue_id' => 1,
            'team_red_id' => 2,
            'serie_id' => 1,
            'number' => 1,
            'team_blue_result' => 'L',
            'team_red_result' => 'W']);

        $team_blue_id = $game1->team_blue_id;
        $team_red_id = $game1->team_red_id;

        $players_team_blue = Player::whereHas('teams', function ($query) use ($team_blue_id) {
            $query->where('id', $team_blue_id);
        })->orderBy('role_id', 'asc')->get();

        $players_team_red = Player::whereHas('teams', function ($query) use ($team_red_id) {
            $query->where('id', $team_red_id);
        })->orderBy('role_id', 'asc')->get();

        $resultados_blue = [
            ['kills' => 1, 'deaths' => 4, 'assists' => 1, 'champion_name' => 'aatrox'],
            ['kills' => 3, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'maokai'],
            ['kills' => 1, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'jayce'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'senna'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'tahm kench']
        ];
        $resultados_red = [
            ['kills' => 5, 'deaths' => 2, 'assists' => 4, 'champion_name' => 'yone'],
            ['kills' => 6, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'oner'],
            ['kills' => 1, 'deaths' => 2, 'assists' => 4, 'champion_name' => 'ahri'],
            ['kills' => 2, 'deaths' => 0, 'assists' => 4, 'champion_name' => 'kalista'],
            ['kills' => 0, 'deaths' => 0, 'assists' => 8, 'champion_name' => 'renata glasc']
        ];

        foreach ($players_team_blue as $index => $player) {
            // Convertir el nombre del campeón a minúsculas
            $champion_name = strtolower($resultados_blue[$index]['champion_name']);

            // Buscar el campeón por su nombre (insensible a mayúsculas y minúsculas)
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();

            // Si el campeón existe, usar su id
            if ($champion) {
                $resultados_blue[$index]['champion_id'] = $champion->id;
            }

            // Eliminar el nombre del campeón del array de resultados
            unset($resultados_blue[$index]['champion_name']);

            $player->games()->attach($game1->id, $resultados[$index]);
        }
        foreach ($players_team_red as $index => $player) {
            // Convertir el nombre del campeón a minúsculas
            $champion_name = strtolower($resultados_red[$index]['champion_name']);

            // Buscar el campeón por su nombre (insensible a mayúsculas y minúsculas)
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();

            // Si el campeón existe, usar su id
            if ($champion) {
                $resultados_red[$index]['champion_id'] = $champion->id;
            }

            // Eliminar el nombre del campeón del array de resultados
            unset($resultados_red[$index]['champion_name']);

            $player->games()->attach($game1->id, $resultados[$index]);
        }
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 2, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 3, 'team_blue_result' => 'L', 'team_red_result' => 'W']);

    }
}
