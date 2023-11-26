<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Javier',
                'email' => 'javier@javier.com',
                'password' => Hash::make('06011997'),
            ],
            [
                'name' => 'Alvaro',
                'email' => 'alvaro@alvaro.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Oscar',
                'email' => 'Oscar@oscar.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Laura',
                'email' => 'Laura@laura.com',
                'password' => Hash::make('12345678'),
            ],
            
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['name' => $user['name']], $user);
        }
    }
}