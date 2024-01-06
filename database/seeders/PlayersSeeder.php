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
        $team_Fnatic = Team::where('name', 'Fnatic')->first();

        $player1 = Player::create([
            'name' => 'Choi',
            'lastname1'=>'Woo-je',
            'nick'=>'Zeus',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '31/1/2004'),
            'country' => 'Korea',
            'photo' => '/players_photos/Zeus.webp',
            'img' => '/players_extra/Zeus.jpg'

        ]);
        $player1->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
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
            '/players_photos/Oner.webp',
            'img' => '/players_extra/Oner.jpg'
        ]);

        $player2->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player3 = Player::create([
            'name' => 'Lee',
            'lastname1'=>'Sang-hyeok',
            'nick'=>'Faker', 'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '7/5/1996'),
            'country' => 'Korea',
            'photo' => '/players_photos/Faker.webp',
            'img' => '/players_extra/Faker.jpg'
        ]);

        $player3->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2013'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player4 = Player::create([
            'name' => 'Lee',
            'lastname1'=>'Min-hyeong',
            'nick'=>'Gumayusi',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'),
            'country' => 'Korea',
            'photo' => '/players_photos/Gumayusi.webp',
            'img' => '/players_extra/Gumayusi.jpg' ]);

        $player4->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
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
            'photo' => '/players_photos/Keria.webp',
            'img' => '/players_extra/Keria.jpg'
        ]);

            $player5->teams()->attach($team_T1->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
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
            'photo' => '/players_photos/Theshy.webp',
            'img' => '/players_extra/Theshy.jpg' ]);

        $player6->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player7 = Player::create([
            'name' => 'Wei ', 'lastname1'=>'Bo-Han',
            'nick'=>'Weiwei',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/8/2000'),
            'country' => 'China',
            'photo' => '/players_photos/Weiwei.webp',
            'img' => '/players_extra/Weiwei.jpg' ]);

        $player7->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player8 = Player::create([
            'name' => 'Li',
            'lastname1'=>'Yuan-Hao',
            'nick'=>'Xiaohu',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '28/1/1998'),
            'country' => 'Korea',
            'photo' => '/players_photos/Xiaohu.webp',
            'img' => '/players_extra/Xiaohu.jpg' ]);

        $player8->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player9 = Player::create([
            'name' => 'Wang',
            'lastname1'=>'Guang-Yu',
            'nick'=>'Light',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'),
            'country' => 'Korea',
            'photo' => '/players_photos/Light.webp',
            'img' => '/players_extra/Light.jpg' ]);

        $player9->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player10 = Player::create([
            'name' => 'Liu',
            'lastname1'=>'Qing-Song',
            'nick'=>'Crisp',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'),
            'country' => 'Korea',
            'photo' => '/players_photos/Crisp.webp',
            'img' => '/players_extra/Crisp.jpg' ]);

        $player10->teams()->attach($team_Weibo->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        //JDG

        $player11 = Player::create([
            'name' => 'Bai',
            'lastname1'=>'Jia-Hao',
            'nick'=>'369',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '12/07/2001'),
            'country' => 'China',
            'photo' => '/players_photos/369.webp',
            'img' => '/players_extra/369.jpg' ]);

        $player11->teams()->attach($team_JDG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player12 = Player::create([
            'name' => 'Seo',
            'lastname1'=>'Jin-hyeok',
            'nick'=>'Kanavi',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '02/09/2000'),
            'country' => 'korea',
            'photo' => '/players_photos/Kanavi.webp',
            'img' => '/players_extra/Kanavi.jpg' ]);

        $player12->teams()->attach($team_JDG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2019'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player13 = Player::create([
            'name' => 'Zhuo',
            'lastname1'=>'Ding',
            'nick'=>'Knight',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '22/05/2000'),
            'country' => 'China',
            'photo' => '/players_photos/Knight.webp',
            'img' => '/players_extra/Knight.jpg' ]);

        $player13->teams()->attach($team_JDG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player14 = Player::create([
            'name' => 'Park',
            'lastname1'=>'Jae-hyuk',
            'nick'=>'Ruler',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '22/05/2000'),
            'country' => 'Korea',
            'photo' => '/players_photos/Ruler.webp',
            'img' => '/players_extra/Ruler.jpg' ]);

        $player14->teams()->attach($team_JDG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player15 = Player::create([
            'name' => 'Lou',
            'lastname1'=>'Yun-Feng',
            'nick'=>'MISSING',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '26/05/2001'),
            'country' => 'China',
            'photo' => '/players_photos/MISSING.webp',
            'img' => '/players_extra/MISSING.jpg' ]);

        $player15->teams()->attach($team_JDG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player16 = Player::create([
            'name' => 'LChoi',
            'lastname1'=>'Hyeon-joon',
            'nick'=>'Doran',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '22/07/2000'),
            'country' => 'Korea',
            'photo' => '/players_photos/Doran.webp',
            'img' => '/players_extra/Doran.jpg' ]);

        $player16->teams()->attach($team_GENG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player17 = Player::create([
            'name' => 'Han',
            'lastname1'=>'Wang-ho',
            'nick'=>'Peanut',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '03/02/1998'),
            'country' => 'Korea',
            'photo' => '/players_photos/Peanut.webp',
            'img' => '/players_extra/Peanut.jpg' ]);

        $player17->teams()->attach($team_GENG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player18 = Player::create([
            'name' => 'Jeong',
            'lastname1'=>'Ji-hoon',
            'nick'=>'Chovy',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '03/03/2001'),
            'country' => 'Korea',
            'photo' => '/players_photos/Chovy.webp',
            'img' => '/players_extra/Chovy.jpg' ]);

        $player18->teams()->attach($team_GENG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player19 = Player::create([
            'name' => 'Kim',
            'lastname1'=>'Su-hwan',
            'nick'=>'Peyz',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '05/12/2005'),
            'country' => 'Korea',
            'photo' => '/players_photos/Peyz.webp',
            'img' => '/players_extra/Peyz.jpg' ]);

        $player19->teams()->attach($team_GENG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);
        $player20 = Player::create([
            'name' => 'Yoo',
            'lastname1'=>'Hwan-joong',
            'nick'=>'Delight',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '05/12/2005'),
            'country' => 'Korea',
            'photo' => '/players_photos/Delight.webp',
            'img' => '/players_extra/Delight.jpg' ]);

        $player20->teams()->attach($team_GENG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player21 = Player::create([
            'name' => 'Chen',
            'lastname1'=>'Ze-Bin',
            'nick'=>'Bin',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '28/09/2003'),
            'country' => 'China',
            'photo' => '/players_photos/Bin.webp',
            'img' => '/players_extra/Bin.jpg' ]);

        $player21->teams()->attach($team_BLG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/06/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player22 = Player::create([
            'name' => 'Peng',
            'lastname1'=>'Li-Xun',
            'nick'=>'Xun',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '05/02/2002'),
            'country' => 'China',
            'photo' => '/players_photos/Xun.webp',
            'img' => '/players_extra/Xun.jpg' ]);

        $player22->teams()->attach($team_BLG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player23 = Player::create([
            'name' => 'Zeng',
            'lastname1'=>'Qi',
            'nick'=>'Yagao',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '19/10/1998'),
            'country' => 'China',
            'photo' => '/players_photos/Yagao.webp',
            'img' => '/players_extra/Yagao.jpg' ]);

        $player23->teams()->attach($team_BLG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);
        $player24 = Player::create([
            'name' => 'Zhao',
            'lastname1'=>'Jia-Hao',
            'nick'=>'ELK',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '29/09/2001'),
            'country' => 'China',
            'photo' => '/players_photos/ELK.webp',
            'img' => '/players_extra/ELK.jpg' ]);
        $player24->teams()->attach($team_BLG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player25 = Player::create([
            'name' => 'Luo',
            'lastname1' => 'Wen-Jun',
            'nick' => 'ON',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '12/05/2003'),
            'country' => 'China',
            'photo' => '/players_photos/ON.webp',
            'img' => '/players_extra/ON.jpg'
        ]);

        $player25->teams()->attach($team_BLG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player26 = Player::create([
            'name' => 'Tang',
            'lastname1' => 'Hua-yu',
            'nick' => 'Zika',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '07/07/2003'),
            'country' => 'China',
            'photo' => '/players_photos/Zika.webp',
            'img' => '/players_extra/Zika.jpg'
        ]);

        $player26->teams()->attach($team_LNG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2025')
        ]);

        $player27 = Player::create([
            'name' => 'Lee',
            'lastname1' => 'Seung-yon',
            'nick' => 'Tarzan',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '23/08/1999'),
            'country' => 'Corea',
            'photo' => '/players_photos/Tarzan.webp',
            'img' => '/players_extra/Tarzan.jpg'
        ]);

        $player27->teams()->attach($team_LNG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2021'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player28 = Player::create([
            'name' => 'Lee',
            'lastname1' => 'Ye-chan',
            'nick' => 'Scout',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/03/1998'),
            'country' => 'Corea',
            'photo' => '/players_photos/Scout.webp',
            'img' => '/players_extra/Scout.jpg'
        ]);

        $player28->teams()->attach($team_LNG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player29 = Player::create([
            'name' => 'Chen',
            'lastname1' => 'Wei',
            'nick' => 'Gala',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/03/1998'),
            'country' => 'Corea',
            'photo' => '/players_photos/Gala.webp',
            'img' => '/players_extra/Gala.jpg'
        ]);

        $player29->teams()->attach($team_LNG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/05/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player30 = Player::create([
            'name' => 'Fu',
            'lastname1' => 'Ming-Hang',
            'nick' => 'Hang',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '14/03/1998'),
            'country' => 'Corea',
            'photo' => '/players_photos/Hang.webp',
            'img' => '/players_extra/Hang.jpg'
        ]);

        $player30->teams()->attach($team_LNG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player31 = Player::create([
            'name' => 'Niship',
            'lastname1' => 'Doshi',
            'nick' => 'Dhokla',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '17/07/1997'),
            'country' => 'India',
            'photo' => '/players_photos/Dhokla.webp',
            'img' => '/players_extra/Dhokla.jpg'
        ]);

        $player31->teams()->attach($team_NRG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player32 = Player::create([
            'name' => 'JuanArturo',
            'lastname1' => 'Garcia',
            'nick' => 'Contractz',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '25/09/1999'),
            'country' => 'United States',
            'photo' => '/players_photos/Contractz.webp',
            'img' => '/players_extra/Contractz.jpg'
        ]);

        $player32->teams()->attach($team_NRG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player33 = Player::create([
            'name' => 'Cristian',
            'lastname1' => 'Palafox',
            'nick' => 'Palafox',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '08/07/1998'),
            'country' => 'United States',
            'photo' => '/players_photos/Palafox.webp',
            'img' => '/players_extra/Palafox.jpg'
        ]);

        $player33->teams()->attach($team_NRG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player34 = Player::create([
            'name' => 'IanVictor',
            'lastname1' => 'Huang',
            'nick' => 'FBI',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '11/02/1999'),
            'country' => 'Australia',
            'photo' => '/players_photos/FBI.webp',
            'img' => '/players_extra/FBI.jpg'
        ]);

        $player34->teams()->attach($team_NRG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player35 = Player::create([
            'name' => 'Lee',
            'lastname1' => 'Dong-geun',
            'nick' => 'IgNar',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '20/11/1996'),
            'country' => 'Korea',
            'photo' => '/players_photos/IgNar.webp',
            'img' => '/players_extra/IgNar.jpg'
        ]);

        $player35->teams()->attach($team_NRG->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player36 = Player::create([
            'name' => 'Kim',
            'lastname1' => 'Gi-in',
            'nick' => 'Kiin',
            'lastname2' => null,
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '28/05/1999'),
            'country' => 'Korea',
            'photo' => '/players_photos/Kiin.webp',
            'img' => '/players_extra/Kiin.jpg'
        ]);

        $player36->teams()->attach($team_KT->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player37 = Player::create([
            'name' => 'Moon',
            'lastname1' => 'Woo-chan',
            'nick' => 'Cuzz',
            'lastname2' => null,
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '30/10/1999'),
            'country' => 'Korea',
            'photo' => '/players_photos/Cuzz.webp',
            'img' => '/players_extra/Cuzz.jpg'
        ]);

        $player37->teams()->attach($team_KT->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player38 = Player::create([
            'name' => 'Gwak',
            'lastname1' => 'Bo-seong',
            'nick' => 'Bdd',
            'lastname2' => null,
            'role_id' => 3,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '01/03/1999'),
            'country' => 'Korea',
            'photo' => '/players_photos/Bdd.webp',
            'img' => '/players_extra/Bdd.jpg'
        ]);

        $player38->teams()->attach($team_KT->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2024')
        ]);

        $player39 = Player::create([
            'name' => 'Kimk',
            'lastname1' => 'Ha-ram',
            'nick' => 'Aiming',
            'lastname2' => null,
            'role_id' => 4,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '20/07/2000'),
            'country' => 'Korea',
            'photo' => '/players_photos/Aiming.webp',
            'img' => '/players_extra/Aiming.jpg'
        ]);

        $player39->teams()->attach($team_KT->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player40 = Player::create([
            'name' => 'Son',
            'lastname1' => 'Si-woo',
            'nick' => 'Lehends',
            'lastname2' => null,
            'role_id' => 5,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '24/12/1998'),
            'country' => 'Korea',
            'photo' => '/players_photos/Lehends.webp',
            'img' => '/players_extra/Lehends.jpg'
        ]);

        $player40->teams()->attach($team_KT->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2023')
        ]);

        $player41 = Player::create([
            'name' => 'Oscar',
            'lastname1' => 'Muñoz',
            'nick' => 'Oscarinin',
            'lastname2' => 'Jiménez',
            'role_id' => 1,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '11/07/2003'),
            'country' => 'Spain',
            'photo' => '/players_photos/Oscarinin.png',
            'img' => '/players_extra/Oscarinin.jpg'
        ]);

        $player41->teams()->attach($team_Fnatic->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2023'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2025')
        ]);

        $player42 = Player::create([
            'name' => 'Iván',
            'lastname1' => 'Martín',
            'nick' => 'Razork',
            'lastname2' => 'Díaz',
            'role_id' => 2,
            'birth_date' => Carbon::createFromFormat('d/m/Y', '07/09/2000'),
            'country' => 'Korea',
            'photo' => '/players_photos/Razork.png',
            'img' => '/players_extra/Razork.jpg'
        ]);

        $player42->teams()->attach($team_Fnatic->id, [
            'start_date' => Carbon::createFromFormat('d/m/Y', '01/01/2022'),
            'contract_expiration_date' => Carbon::createFromFormat('d/m/Y', '31/12/2026')
        ]);
    }
}
