<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;
use Carbon\Carbon;

class ClasificationsSeeder extends Seeder
{
    public function run()
    {
        $t1_players = Player::whereHas('teams', function ($query) {
            $query->where('name', 'T1');
        })->whereHas('games', function ($query) {
            $now = Carbon::now();
            $query->whereDate('start_date', '<=', now())
                  ->whereDate('end_date', '>=', now());
        })->get();

    }
}
    
