<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionsTableSeeder extends Seeder
{
    public function run()
    {
        $competitions = [
            [
                'name' => 'LEC',
                'region' => 'Europe',
            ],
            [
                'name' => 'LCS',
                'region' => 'North America',
            ],
            [
                'name' => 'LCK',
                'region' => 'South Korea',
            ],
            [
                'name' => 'LPL',
                'region' => 'China',
            ],
            [
                'name' => 'Worlds',
                'region' => 'International',
            ],
            [
                'name' => 'MSI',
                'region' => 'International',
            ],
        ];

        foreach ($competitions as $competition) {
            Competition::create($competition);
        }
    }
}
