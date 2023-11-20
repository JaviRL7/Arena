<?php

namespace Database\Seeders;
use App\Models\History;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        History::create(['team_id' => 2, 'player_id' => 1, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 2, 'player_id' => 2, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 2, 'player_id' => 3, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2013'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')]);
        History::create(['team_id' => 2, 'player_id' => 4, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 2, 'player_id' => 5, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);

        History::create(['team_id' => 1, 'player_id' => 6, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 1, 'player_id' => 7, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 1, 'player_id' => 8, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 1, 'player_id' => 9, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        History::create(['team_id' => 1, 'player_id' => 10, 'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')]);
        ;
    }
}
