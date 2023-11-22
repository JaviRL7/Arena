<?php

namespace Database\Seeders;
use App\Models\Game;
use App\Models\Player;
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
            

            $team_blue = Player::whereHas('teams', function ($query) use ($game1) {
                $query->where('id', $game1->team_blue_id);
            })->orderBy('role_id')->get();            
            
            //$team_red = Player::where('team', 'red')->orderBy('role_id')->get();
            
            $resultados = [
                ['kills' => 10, 'deaths' => 4, 'assists' => 23, 'champion_id' => 1],
                ['kills' => 3, 'deaths' => 0, 'assists' => 13, 'champion_id' => 1],
                ['kills' => 3, 'deaths' => 0, 'assists' => 13, 'champion_id' => 1],
                ['kills' => 3, 'deaths' => 0, 'assists' => 13, 'champion_id' => 1],
                ['kills' => 3, 'deaths' => 0, 'assists' => 13, 'champion_id' => 1],
            ];
    
            foreach ($team_blue as $index => $player) {
                $game1->players()->attach($player->id, $resultados[$index]);
            }

            //foreach ($team_red as $index => $player) {
            //    $game1->players()->attach($player->id, $resultados[$index + count($team_blue)]);
            //} 
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 2, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 3, 'team_blue_result' => 'L', 'team_red_result' => 'W']);

    }
}
