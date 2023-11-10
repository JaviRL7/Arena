<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Top Laner'],
            ['name' => 'Jungler'],
            ['name' => 'Mid Laner'],
            ['name' => 'Bot Laner'],
            ['name' => 'Support'],
            // Puedes agregar más roles aquí según sea necesario
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
