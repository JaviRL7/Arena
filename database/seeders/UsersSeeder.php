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
                'nick' => 'Yoh_R0',
                'email' => 'javier@javier.com',
                'admin' => true,
                'password' => Hash::make('06011997'),
                'user_photo' => 'Profile_photos/Javier.jpg'
            ],
            [
                'name' => 'Alvaro',
                'email' => 'alvaro@alvaro.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Oscar',
                'email' => 'oscar@oscar.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Laura',
                'email' => 'laura@laura.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Jesus',
                'email' => 'jesus@jesus.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Anabel',
                'email' => 'anabel@anabel.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Celia',
                'email' => 'celia@celia.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Andres',
                'email' => 'andres@andres.com',
                'password' => Hash::make('12345678'),
            ],

        ];

        foreach ($users as $user) {
            User::updateOrCreate(['name' => $user['name']], $user);
        }
    }
}
