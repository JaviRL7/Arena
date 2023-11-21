<?php

namespace Database\Seeders;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team_T1 = Team::where('name', 'T1')->first();
        $team_Weibo = Team::where('name', 'Weibo Gaming')->first();
        $team_JDG = Team::where('name', 'JDG')->first();
        $team_GENG = Team::where('name', 'GENG')->first();
        $team_BLG = Team::where('name', 'BLG')->first();
        $team_KT = Team::where('name', 'KT')->first();
        $team_NRG = Team::where('name', 'NRG')->first();
        $team_LNG = Team::where('name', 'LNG')->first();

        $player1 = Player::create([
            'name' => 'Choi', 
            'lastname1'=>'Woo-je', 
            'nick'=>'Zeus', 
            'lastname2' => null, 
            'role_id' => 1, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '31/1/2004'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Zeus.webp'
        ]);
        $player1->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        //Player::create(['name' => 'Mun', 'lastname1'=>'Hyeon-jun', 'nick'=>'Oner', 'lastname2' => null, 'role_id' => 2, 'birth_date' => Carbon::createFromFormat('d/m/Y', '24/12/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Oner.webp' ]);
        //Player::create(['name' => 'Lee', 'lastname1'=>'Sang-hyeok', 'nick'=>'Faker', 'lastname2' => null, 'role_id' => 3, 'birth_date' => Carbon::createFromFormat('d/m/Y', '7/5/1996'), 'country' => 'Korea', 'photo' => '/players_photos/Faker.webp' ]);
        //Player::create(['name' => 'Lee', 'lastname1'=>'Min-hyeong', 'nick'=>'Gumayusi', 'lastname2' => null, 'role_id' => 4, 'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Gumayusi.webp' ]);
        //Player::create(['name' => 'Ryu', 'lastname1'=>'Min-seok', 'nick'=>'Keria', 'lastname2' => null, 'role_id' => 5, 'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Keria.webp' ]);
        $player2 = Player::create([
            'name' => 'Mun', 
            'lastname1'=>'Hyeon-jun', 
            'nick'=>'Oner', 
            'lastname2' => null, 
            'role_id' => 2, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '24/12/2002'), 
            'country' => 'Korea', 
            'photo' => 
            '/players_photos/Oner.webp' ]);

        $player2->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player3 = Player::create([
            'name' => 'Lee', 
            'lastname1'=>'Sang-hyeok', 
            'nick'=>'Faker', 'lastname2' => null, 
            'role_id' => 3, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '7/5/1996'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Faker.webp' ]);

        $player3->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2013'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player4 = Player::create([
            'name' => 'Lee', 
            'lastname1'=>'Min-hyeong', 
            'nick'=>'Gumayusi', 
            'lastname2' => null, 
            'role_id' => 4, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Gumayusi.webp' ]);

        $player4->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player5 = Player::create([
            'name' => 'Ryu', 
            'lastname1'=>'Min-seok', 
            'nick'=>'Keria', 
            'lastname2' => null, 
            'role_id' => 5, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'), 
            'country' => 
            'Korea', 
            'photo' => '/players_photos/Keria.webp' ]);
        
            $player5->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        //Player::create(['name' => 'Kang', 'lastname1'=>'Seung-lok', 'nick'=>'Theshy', 'lastname2' => null, 'role_id' => 1, 'birth_date' => Carbon::createFromFormat('d/m/Y', '11/11/1999'), 'country' => 'Korea', 'photo' => '/players_photos/Theshy.webp' ]);
        //Player::create(['name' => 'Wei ', 'lastname1'=>'Bo-Han', 'nick'=>'Weiwei', 'lastname2' => null, 'role_id' => 2, 'birth_date' => Carbon::createFromFormat('d/m/Y', '14/8/2000'), 'country' => 'China', 'photo' => '/players_photos/Weiwei.webp' ]);
        //Player::create(['name' => 'Li', 'lastname1'=>'Yuan-Hao', 'nick'=>'Xiaohu', 'lastname2' => null, 'role_id' => 3, 'birth_date' => Carbon::createFromFormat('d/m/Y', '28/1/1998'), 'country' => 'Korea', 'photo' => '/players_photos/Xiaohu.webp' ]);
        //Player::create(['name' => 'Wang', 'lastname1'=>'Guang-Yu', 'nick'=>'Light', 'lastname2' => null, 'role_id' => 4, 'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Light.webp' ]);
        //Player::create(['name' => 'Liu', 'lastname1'=>'Qing-Song', 'nick'=>'Crisp', 'lastname2' => null, 'role_id' => 5, 'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Crisp.webp' ]);
        $player6 = Player::create([
            'name' => 'Kang', 
            'lastname1'=>'Seung-lok', 
            'nick'=>'Theshy', 
            'lastname2' => null, 
            'role_id' => 1, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '11/11/1999'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Theshy.webp' ]);
        
        $player6->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player7 = Player::create([
            'name' => 'Wei ', 'lastname1'=>'Bo-Han', 
            'nick'=>'Weiwei', 
            'lastname2' => null, 
            'role_id' => 2, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/8/2000'), 
            'country' => 'China', 
            'photo' => '/players_photos/Weiwei.webp' ]);

        $player7->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player8 = Player::create([
            'name' => 'Li', 
            'lastname1'=>'Yuan-Hao', 
            'nick'=>'Xiaohu', 
            'lastname2' => null, 
            'role_id' => 3, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '28/1/1998'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Xiaohu.webp' ]);
        
        $player8->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player9 = Player::create([
            'name' => 'Wang', 
            'lastname1'=>'Guang-Yu', 
            'nick'=>'Light', 
            'lastname2' => null, 
            'role_id' => 4, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Light.webp' ]);
        
        $player9->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player10 = Player::create([
            'name' => 'Liu', 
            'lastname1'=>'Qing-Song', 
            'nick'=>'Crisp', 
            'lastname2' => null, 
            'role_id' => 5, 
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'), 
            'country' => 'Korea', 
            'photo' => '/players_photos/Crisp.webp' ]);
        
        $player10->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'), 
            'end_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        
    }
}
