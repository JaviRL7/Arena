<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ChampionsSeeder::class,
            CompetitionsSeeder::class,
            TeamsSeeder::class,
            RolesSeeder::class,
            SeriesSeeder::class,

            PlayersSeeder::class,
            GamesSeeder::class,
            // Otros seeders si los tienes
        ]);
    }
}
