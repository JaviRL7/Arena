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
        Serie::create(['team_1_id' => 1, 'team_2_id' => 2, 'competition_id' => 2, 'name' => 'Finale', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);
        //serie t1-jdg
        Serie::create(['team_1_id' => 2, 'team_2_id' => 4, 'competition_id' => 2, 'name' => 'Semi-final', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);

        Serie::create(['team_1_id' => 6, 'team_2_id' => 1, 'competition_id' => 2, 'name' => 'Semi-final', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);

        Serie::create(['team_1_id' => 1, 'team_2_id' => 3, 'competition_id' => 2, 'name' => 'Quarterfinals', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);
        Serie::create(['team_1_id' => 5, 'team_2_id' => 4, 'competition_id' => 2, 'name' => 'Quarterfinals', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);
        Serie::create(['team_1_id' => 8, 'team_2_id' => 6, 'competition_id' => 2, 'name' => 'Quarterfinals', 'type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);
        Serie::create(['team_1_id' => 2, 'team_2_id' => 7, 'competition_id' => 2, 'name' => 'Quarterfinals','type' => 'bo5', 'date' => Carbon::createFromFormat('d/m/Y', '19/11/2023')]);

        $team_ids = range(9, 18);
        $dates = ['27/01/2024', '28/01/2024', '29/01/2024', '03/02/2024', '04/02/2024', '05/02/2024', '10/02/2024', '11/02/2024', '12/02/2024'];
        $matchups = [];
        $match_counter = 0;

        for ($i = 0; $i < count($dates); $i++) {
            shuffle($team_ids);
            for ($j = 0; $j < count($team_ids) / 2; $j++) {
                $team_1_id = $team_ids[$j];
                $team_2_id = $team_ids[count($team_ids) - $j - 1];
                if ($team_1_id != $team_2_id && !in_array([$team_2_id, $team_1_id], $matchups)) {
                    $matchups[] = [$team_1_id, $team_2_id];
                    $date = $dates[$i];
                    $hour = 17 + $j;
                    Serie::create([
                        'team_1_id' => $team_1_id,
                        'team_2_id' => $team_2_id,
                        'competition_id' => 1,
                        'name' => 'Regular split',
                        'type' => 'bo1',
                        'date' => Carbon::createFromFormat('d/m/Y H', $date . ' ' . $hour),
                        'hour' => Carbon::createFromFormat('H', $hour)->format('H:i:s')

                    ]);
                    $match_counter++;
                }
            }
        }
    }
}
