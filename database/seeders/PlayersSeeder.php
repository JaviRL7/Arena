<?php

namespace Database\Seeders;
use App\Models\Player;
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
        Player::create(['name' => 'Choi', 'lastname1'=>'Woo-je', 'nick'=>'Zeus', 'lastname2' => null, 'role_id' => 1, 'birth_date' => Carbon::createFromFormat('d/m/Y', '31/1/2004'), 'country' => 'Korea', 'photo' => '/players_photos/Zeus.webp' ]);
        Player::create(['name' => 'Mun', 'lastname1'=>'Hyeon-jun', 'nick'=>'Oner', 'lastname2' => null, 'role_id' => 2, 'birth_date' => Carbon::createFromFormat('d/m/Y', '24/12/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Oner.webp' ]);
        Player::create(['name' => 'Lee', 'lastname1'=>'Sang-hyeok', 'nick'=>'Faker', 'lastname2' => null, 'role_id' => 3, 'birth_date' => Carbon::createFromFormat('d/m/Y', '7/5/1996'), 'country' => 'Korea', 'photo' => '/players_photos/Faker.webp' ]);
        Player::create(['name' => 'Lee', 'lastname1'=>'Min-hyeong', 'nick'=>'Gumayusi', 'lastname2' => null, 'role_id' => 4, 'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Gumayusi.webp' ]);
        Player::create(['name' => 'Ryu', 'lastname1'=>'Min-seok', 'nick'=>'Keria', 'lastname2' => null, 'role_id' => 5, 'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Keria.webp' ]);
        
        Player::create(['name' => 'Kang', 'lastname1'=>'Seung-lok', 'nick'=>'Theshy', 'lastname2' => null, 'role_id' => 1, 'birth_date' => Carbon::createFromFormat('d/m/Y', '11/11/1999'), 'country' => 'Korea', 'photo' => '/players_photos/Theshy.webp' ]);
        Player::create(['name' => 'Wei ', 'lastname1'=>'Bo-Han', 'nick'=>'Weiwei', 'lastname2' => null, 'role_id' => 2, 'birth_date' => Carbon::createFromFormat('d/m/Y', '14/8/2000'), 'country' => 'China', 'photo' => '/players_photos/Weiwei.webp' ]);
        Player::create(['name' => 'Li', 'lastname1'=>'Yuan-Hao', 'nick'=>'Xiaohu', 'lastname2' => null, 'role_id' => 3, 'birth_date' => Carbon::createFromFormat('d/m/Y', '28/1/1998'), 'country' => 'Korea', 'photo' => '/players_photos/Xiaohu.webp' ]);
        Player::create(['name' => 'Wang', 'lastname1'=>'Guang-Yu', 'nick'=>'Light', 'lastname2' => null, 'role_id' => 4, 'birth_date' => Carbon::createFromFormat('d/m/Y', '6/2/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Light.webp' ]);
        Player::create(['name' => 'Liu', 'lastname1'=>'Qing-Song', 'nick'=>'Crisp', 'lastname2' => null, 'role_id' => 5, 'birth_date' => Carbon::createFromFormat('d/m/Y', '14/10/2002'), 'country' => 'Korea', 'photo' => '/players_photos/Crisp.webp' ]);


        
    }
}
