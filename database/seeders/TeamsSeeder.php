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
    }
}
