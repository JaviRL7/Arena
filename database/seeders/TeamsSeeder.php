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
        Team::create(['name' => 'G2', 'league_id'=>1, 'logo' => 'teams_logo/G2_logo.png', 'team_photo' => 'teams/g2_team.jpg']);
        Team::create(['name' => 'Fnatic', 'league_id'=>1, 'logo' => 'teams_logo/Fnatic_logo.png', 'team_photo' => 'teams/fnatic_team.jpg']);
        Team::create(['name' => 'KOI', 'league_id'=>1, 'logo' => 'teams_logo/KOI_logo.png', 'team_photo' => 'teams/koi_team.jpg']);
        Team::create(['name' => 'Heretics', 'league_id'=>1, 'logo' => 'teams_logo/Heretics_logo.png', 'team_photo' => 'teams/heretics_team.jpg']);
        Team::create(['name' => 'Kcorp', 'league_id'=>1, 'logo' => 'teams_logo/Kcorp_logo.png', 'team_photo' => 'teams/kcorp_team.jpg']);
        Team::create(['name' => 'BDS', 'league_id'=>1, 'logo' => 'teams_logo/BDS_logo.png', 'team_photo' => 'teams/bds_team.jpg']);
        Team::create(['name' => 'Rogue', 'league_id'=>1, 'logo' => 'teams_logo/Rogue_logo.png', 'team_photo' => 'teams/rogue_team.jpg']);
        Team::create(['name' => 'Giantx', 'league_id'=>1, 'logo' => 'teams_logo/Giantx_logo.png', 'team_photo' => 'teams/giantx_team.jpg']);
        Team::create(['name' => 'Vitality', 'league_id'=>1, 'logo' => 'teams_logo/Vitality_logo.png', 'team_photo' => 'teams/vitality_team.jpg']);
        Team::create(['name' => 'SK', 'league_id'=>1, 'logo' => 'teams_logo/SK_logo.png', 'team_photo' => 'teams/sk_team.jpg']);
        Team::create(['name' => 'Dplus KIA', 'league_id'=>3, 'logo' => 'teams_logo/Dplus_KIA_logo.png', 'team_photo' => 'teams/dplus_kia_team.jpg']);
        Team::create(['name' => 'DRX', 'league_id'=>3, 'logo' => 'teams_logo/DRX_logo.png', 'team_photo' => 'teams/drx_team.jpg']);
        Team::create(['name' => 'BRION', 'league_id'=>3, 'logo' => 'teams_logo/BRION_logo.png', 'team_photo' => 'teams/brion_team.jpg']);
        Team::create(['name' => 'Liiv Sandbox', 'league_id'=>3, 'logo' => 'teams_logo/Liiv_Sandbox_logo.png', 'team_photo' => 'teams/liiv_sandbox_team.jpg']);
        Team::create(['name' => 'Nongshim RedForce', 'league_id'=>3, 'logo' => 'teams_logo/Nongshim_RedForce_logo.png', 'team_photo' => 'teams/nongshim_redforce_team.jpg']);
        Team::create(['name' => 'Kwangdom Freecs', 'league_id'=>3, 'logo' => 'teams_logo/Kwangdom_Freecs_logo.png', 'team_photo' => 'teams/kwangdom_freecs_team.jpg']);
        Team::create(['name' => 'Hanwha Life Esports', 'league_id'=>3, 'logo' => 'teams_logo/Hanwha_Life_Esports_logo.png', 'team_photo' => 'teams/hanwha_life_esports_team.jpg']);
    }
}
