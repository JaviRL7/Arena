<?php

namespace Database\Seeders;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create(['name' => 'Weibo Gaming', 'logo' => 'teams_logo/Weibo_logo.png']);
        Team::create(['name' => 'T1', 'logo' => 'teams_logo/T1_logo.png']);
        Team::create(['name' => 'NRG', 'logo' => 'teams_logo/NRG_logo.png']);
        Team::create(['name' => 'JDG', 'logo' => 'teams_logo/JDG_logo.png']);
        Team::create(['name' => 'KT', 'logo' => 'teams_logo/KT_logo.png']);
        Team::create(['name' => 'BLG', 'logo' => 'teams_logo/BLG_logo.png']);
        Team::create(['name' => 'LNG', 'logo' => 'teams_logo/LNG_logo.png']);
        Team::create(['name' => 'GENG', 'logo' => 'teams_logo/GenG_logo.png']);
    }
}
