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
        Competition::create(['name' => 'LEC', 'region' => 'Europe','logo' => 'competition_logo/LEC_logo.png']);
        Competition::create(['name' => 'Worlds', 'region' => 'International','logo' => 'competition_logo/Worlds_logo.png']);
        Competition::create(['name' => 'LCK', 'region' => 'Korea','logo' => 'competition_logo/LCk_logo.png']);
    }
}
