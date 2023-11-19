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
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2,'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'type' => 'bo5', 'competition_id' => 2, 'number' => 1, 'team_blue_score' => 0, 'team_red_score' => 3]);
        Game::create(['team_blue_id' => 1, 'team_red_id' => 2,'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'type' => 'bo5', 'competition_id' => 2, 'number' => 2, 'team_blue_score' => 0, 'team_red_score' => 3]);
    }
}
