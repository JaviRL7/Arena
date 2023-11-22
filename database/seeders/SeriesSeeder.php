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
        Serie::create(['team_1_id' => 1, 'team_2_id' => 2, 'competition_id' => 1, 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 1, 'team_2_id' => 2, 'competition_id' => 1, 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 1, 'team_2_id' => 2, 'competition_id' => 1, 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);
        Serie::create(['team_1_id' => 1, 'team_2_id' => 2, 'competition_id' => 1, 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023'), 'competition_id' => 2 ]);

    }
}
