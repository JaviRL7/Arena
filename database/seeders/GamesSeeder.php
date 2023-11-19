<?php

namespace Database\Seeders;
use App\Models\Game;
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
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 1, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 2, 'team_blue_result' => 'L', 'team_red_result' => 'W']);
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2, 'serie_id' => 1, 'number' => 3, 'team_blue_result' => 'L', 'team_red_result' => 'W']);

    }
}
