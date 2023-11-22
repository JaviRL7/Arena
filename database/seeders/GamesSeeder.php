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
            ['kills' => 6, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'lee sin'],
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

            $player->games()->attach($game1->id, $resultados_blue[$index]);
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

            $player->games()->attach($game1->id, $resultados_red[$index]);
        }
        $game2 = Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 2, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        
        $team_blue_id = $game2->team_blue_id;
        $team_red_id = $game2->team_red_id;
        
        $resultados_blue = [
            ['kills' => 0, 'deaths' => 6, 'assists' => 1, 'champion_name' => 'aatrox'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'maokai'],
            ['kills' => 1, 'deaths' => 1, 'assists' => 0, 'champion_name' => 'ahri'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 2, 'champion_name' => 'kalista'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'senna']
        ];
        $resultados_red = [
            ['kills' => 5, 'deaths' => 1, 'assists' => 6, 'champion_name' => 'gwen'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 7, 'champion_name' => 'nocturne'],
            ['kills' => 1, 'deaths' => 0, 'assists' => 6, 'champion_name' => 'sylas'],
            ['kills' => 3, 'deaths' => 0, 'assists' => 6, 'champion_name' => 'Draven'],
            ['kills' => 0, 'deaths' => 0, 'assists' => 11, 'champion_name' => 'renata glasc']
        ];
        foreach ($players_team_blue as $index => $player) {
            $champion_name = strtolower($resultados_blue[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $resultados_blue[$index]['champion_id'] = $champion->id;
            }
            unset($resultados_blue[$index]['champion_name']);
            $player->games()->attach($game2->id, $resultados_blue[$index]);
        }
        foreach ($players_team_red as $index => $player) {
            $champion_name = strtolower($resultados_red[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $resultados_red[$index]['champion_id'] = $champion->id;
            }
            unset($resultados_red[$index]['champion_name']);
            $player->games()->attach($game2->id, $resultados_red[$index]);
        }
        $game3 = Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 3, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        $team_blue_id = $game3->team_blue_id;
        $team_red_id = $game3->team_red_id;
        
        $resultados_blue = [
            ['kills' => 0, 'deaths' => 6, 'assists' => 3, 'champion_name' => 'kennen'],
            ['kills' => 2, 'deaths' => 4, 'assists' => 3, 'champion_name' => 'bel\'veth'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 0, 'champion_name' => 'azir'],
            ['kills' => 2, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'varus'],
            ['kills' => 1, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'bard']
        ];
        $resultados_red = [
            ['kills' => 6, 'deaths' => 1, 'assists' => 7, 'champion_name' => 'aatrox'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 11, 'champion_name' => 'lee sin'],
            ['kills' => 6, 'deaths' => 1, 'assists' => 9, 'champion_name' => 'akali'],
            ['kills' => 2, 'deaths' => 0, 'assists' => 5, 'champion_name' => 'xayah'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 16, 'champion_name' => 'rakan']
        ];
        foreach ($players_team_blue as $index => $player) {
            $champion_name = strtolower($resultados_blue[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $resultados_blue[$index]['champion_id'] = $champion->id;
            }
            unset($resultados_blue[$index]['champion_name']);
            $player->games()->attach($game3->id, $resultados_blue[$index]);
        }
        foreach ($players_team_red as $index => $player) {
            $champion_name = strtolower($resultados_red[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $resultados_red[$index]['champion_id'] = $champion->id;
            }
            unset($resultados_red[$index]['champion_name']);
            $player->games()->attach($game3->id, $resultados_red[$index]);
        }



        ///////////

        $game4 = Game::create(['team_blue_id' => 3, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 3, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        $team_blue_id = $game3->team_blue_id;
        $team_red_id = $game3->team_red_id;
        
        $resultados_blue = [
            ['kills' => 0, 'deaths' => 6, 'assists' => 3, 'champion_name' => 'kennen'],
            ['kills' => 2, 'deaths' => 4, 'assists' => 3, 'champion_name' => 'bel\'veth'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 0, 'champion_name' => 'azir'],
            ['kills' => 2, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'varus'],
            ['kills' => 1, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'bard']
        ];
        $resultados_red = [
            ['kills' => 6, 'deaths' => 1, 'assists' => 7, 'champion_name' => 'aatrox'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 11, 'champion_name' => 'lee sin'],
            ['kills' => 6, 'deaths' => 1, 'assists' => 9, 'champion_name' => 'akali'],
            ['kills' => 2, 'deaths' => 0, 'assists' => 5, 'champion_name' => 'xayah'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 16, 'champion_name' => 'rakan']
        ];
        foreach ($players_team_blue as $index => $player) {
            $champion_name = strtolower($resultados_blue[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $resultados_blue[$index]['champion_id'] = $champion->id;
            }
            unset($resultados_blue[$index]['champion_name']);
            $player->games()->attach($game3->id, $resultados_blue[$index]);
        }
        foreach ($players_team_red as $index => $player) {
            $champion_name = strtolower($resultados_red[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $resultados_red[$index]['champion_id'] = $champion->id;
            }
            unset($resultados_red[$index]['champion_name']);
            $player->games()->attach($game3->id, $resultados_red[$index]);
        }
    }
}
