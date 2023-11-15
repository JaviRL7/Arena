<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Fnatic',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'England',
                'competition_id' => 1,
                'logo' => 'Logos/Fnc_logo.webp',

            ],
            [
                'name' => 'G2 Esports',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Germany',
                'competition_id' => 1,
                'logo' => 'Logos/G2_logo.webp',

            ],
            [
                'name' => 'SK Esports',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Germany',
                'competition_id' => 1,
                'logo' => 'Logos/sk_logo.png',

            ],
            [
                'name' => 'KOI',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Spain',
                'competition_id' => 1,
                'logo' => 'Logos/koi_logo.webp',
            ],
            [
                'name' => 'Karmine Corp',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'France',
                'competition_id' => 1,
                'logo' => 'Logos/kc_logo.webp',
            ],
            [
                'name' => 'BDS',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Switzerland',
                'competition_id' => 1,
                'logo' => 'Logos/bds_logo.webp',
            ],
            [
                'name' => 'Vitality',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'France',
                'competition_id' => 1,
                'logo' => 'Logos/vit_logo.webp',
            ],
            [
                'name' => 'Giants',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Spain/England',
                'competition_id' => 1,
                'logo' => 'Logos/Gia_logo.webp',
            ],
            [
                'name' => 'Heretics',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Spain',
                'competition_id' => 1,
                'logo' => 'Logos/hrt_logo.webp',
            ],
            [
                'name' => 'Rogue',
                'league' => 'Europe',
                'league' => 'LEC',
                'country' => 'Poland',
                'competition_id' => 1,
                'logo' => 'Logos/rog.png',
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
