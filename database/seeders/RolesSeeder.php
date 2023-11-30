<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Top', 'icono' => 'icons/Top_logo.png']);
        Role::create(['name' => 'Jungler', 'icono' => 'icons/Jungler_logo.png']);
        Role::create(['name' => 'Mid', 'icono' => 'icons/Mid_logo.png']);
        Role::create(['name' => 'ADC', 'icono' => 'icons/ADC_logo.png']);
        Role::create(['name' => 'Support', 'icono' => 'icons/Support_logo.png']);
    }
}
