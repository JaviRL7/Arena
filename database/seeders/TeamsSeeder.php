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
        Team::create(['name' => 'Weibo Gaming','league_id'=>4, 'logo' => 'teams_logo/Weibo_logo.png', 'team_photo' => 'teams/weibo_team.jpg']);
        Team::create(['name' => 'T1','league_id'=>3, 'logo' => 'teams_logo/T1_logo.png', 'team_photo' => 'teams/t1_team.jpg']);
        Team::create(['name' => 'NRG','league_id'=>5, 'logo' => 'teams_logo/NRGlogo.webp', 'team_photo' => 'teams/nrg_team.jpg']);
        Team::create(['name' => 'JDG','league_id'=>4, 'logo' => 'teams_logo/JDG_logo.webp' , 'team_photo' => 'teams/jdg_team.jpg']);
        Team::create(['name' => 'KT','league_id'=>3, 'logo' => 'teams_logo/KT_logo.webp', 'team_photo' => 'teams/kt_team.jpg']);
        Team::create(['name' => 'BLG','league_id'=>4, 'logo' => 'teams_logo/BLG_logo.png' , 'team_photo' => 'teams/blg_team.jpg']);
        Team::create(['name' => 'LNG','league_id'=>4, 'logo' => 'teams_logo/LNG_logo.webp' , 'team_photo' => 'teams/lng_team.jpg']);
        Team::create(['name' => 'GENG','league_id'=>3, 'logo' => 'teams_logo/GenG_logo.webp' , 'team_photo' => 'teams/geng_team.jpg']);
    }
}
