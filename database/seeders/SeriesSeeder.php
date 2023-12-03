<?php

namespace Database\Seeders;
use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Serie::create(['team_1_id' => 1, 'team_2_id' => 2, 'competition_id' => 1, 'name' => 'Finale ', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        //serie t1-jdg
        Serie::create(['team_1_id' => 2, 'team_2_id' => 4, 'competition_id' => 1, 'name' => 'Semi-final', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);

        Serie::create(['team_1_id' => 6, 'team_2_id' => 1, 'competition_id' => 1, 'name' => 'Semi-final', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 1, 'team_2_id' => 3, 'competition_id' => 1, 'name' => 'Quarterfinals', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 5, 'team_2_id' => 4, 'competition_id' => 1, 'name' => 'Quarterfinals', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 8, 'team_2_id' => 6, 'competition_id' => 1, 'name' => 'Quarterfinals', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 2, 'team_2_id' => 7, 'competition_id' => 1, 'name' => 'Quarterfinals','type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
    }
}
