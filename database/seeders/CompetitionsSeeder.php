<?php

namespace Database\Seeders;
use App\Models\Competition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Competition::create(['name' => 'LEC', 'region' => 'Europe','logo' => 'competition_logo/lec_logo.webp']);
        Competition::create(['name' => 'Worlds', 'region' => 'International','logo' => 'competition_logo/worlds_logo.png']);
        Competition::create(['name' => 'LCK', 'region' => 'Korea','logo' => 'competition_logo/lck_logo.webp']);
        Competition::create(['name' => 'LPL', 'region' => 'China','logo' => 'competition_logo/lpl_logo.png']);
        Competition::create(['name' => 'LCS', 'region' => 'North America','logo' => 'competition_logo/lcs_logo.webp']);
        Competition::create(['name' => 'MSI', 'region' => 'International','logo' => 'competition_logo/msi_logo.png']);

    }
}
