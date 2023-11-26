<?php

namespace Database\Seeders;
use App\Models\Game;
use App\Models\Player;
use App\Models\Champion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game1 = Game::create([
            'team_blue_id' => 1,
            'team_red_id' => 2,
            'serie_id' => 1,
            'number' => 1,
            'team_blue_result' => 'L',
            'team_red_result' => 'W']);

        $resultados_blue = [
            ['kills' => 1, 'deaths' => 4, 'assists' => 1, 'champion_name' => 'aatrox'],
            ['kills' => 3, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'maokai'],
            ['kills' => 1, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'jayce'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'senna'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'tahm kench']
        ];
        $resultados_red = [
            ['kills' => 5, 'deaths' => 2, 'assists' => 4, 'champion_name' => 'yone'],
            ['kills' => 6, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'lee sin'],
            ['kills' => 1, 'deaths' => 2, 'assists' => 4, 'champion_name' => 'ahri'],
            ['kills' => 2, 'deaths' => 0, 'assists' => 4, 'champion_name' => 'kalista'],
            ['kills' => 0, 'deaths' => 0, 'assists' => 8, 'champion_name' => 'renata glasc']
        ];
        $game1->attachPlayers($resultados_blue, $resultados_red);
        //WEIBO T1 MAPA 2
        $game2 = Game::create([
            'team_blue_id' => 1,
            'team_red_id' => 2,
            'serie_id' => 1,
            'number' => 2,
            'team_blue_result' => 'L',
            'team_red_result' => 'W']);

        $resultados_blue = [
            ['kills' => 0, 'deaths' => 6, 'assists' => 1, 'champion_name' => 'aatrox'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'maokai'],
            ['kills' => 1, 'deaths' => 1, 'assists' => 0, 'champion_name' => 'ahri'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 2, 'champion_name' => 'kalista'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'senna']
        ];
        $resultados_red = [
            ['kills' => 5, 'deaths' => 1, 'assists' => 6, 'champion_name' => 'gwen'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 7, 'champion_name' => 'nocturne'],
            ['kills' => 1, 'deaths' => 0, 'assists' => 6, 'champion_name' => 'sylas'],
            ['kills' => 3, 'deaths' => 0, 'assists' => 6, 'champion_name' => 'Draven'],
            ['kills' => 0, 'deaths' => 0, 'assists' => 11, 'champion_name' => 'renata glasc']
        ];

        $game2->attachPlayers($resultados_blue, $resultados_red);

        //WEIBO T1 MAPA 3
        $game3 = Game::create([
            'team_blue_id' => 1,
            'team_red_id' => 2,
            'serie_id' => 1,
            'number' => 3,
            'team_blue_result' => 'L',
            'team_red_result' => 'W']);

        $resultados_blue = [
            ['kills' => 0, 'deaths' => 6, 'assists' => 3, 'champion_name' => 'kennen'],
            ['kills' => 2, 'deaths' => 4, 'assists' => 3, 'champion_name' => 'bel\'veth'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 0, 'champion_name' => 'azir'],
            ['kills' => 2, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'varus'],
            ['kills' => 1, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'bard']
        ];
        $resultados_red = [
            ['kills' => 6, 'deaths' => 1, 'assists' => 7, 'champion_name' => 'aatrox'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 11, 'champion_name' => 'lee sin'],
            ['kills' => 6, 'deaths' => 1, 'assists' => 9, 'champion_name' => 'akali'],
            ['kills' => 2, 'deaths' => 0, 'assists' => 5, 'champion_name' => 'xayah'],
            ['kills' => 0, 'deaths' => 2, 'assists' => 16, 'champion_name' => 'rakan']
        ];
        $game3->attachPlayers($resultados_blue, $resultados_red);

        //JDG t1 mapa 1

        $game4 = Game::create([
            'team_blue_id' => 2,
            'team_red_id' => 4,
            'serie_id' => 2,
            'number' => 1,
            'team_blue_result' => 'W',
            'team_red_result' => 'L']);

        $resultados_red = [
            ['kills' => 3, 'deaths' => 7, 'assists' => 5, 'champion_name' => 'rumble'],
            ['kills' => 2, 'deaths' => 6, 'assists' => 4, 'champion_name' => 'vi'],
            ['kills' => 2, 'deaths' => 3, 'assists' => 3, 'champion_name' => 'akali'],
            ['kills' => 1, 'deaths' => 2, 'assists' => 6, 'champion_name' => 'xayah'],
            ['kills' => 0, 'deaths' => 5, 'assists' => 4, 'champion_name' => 'alistar']
        ];
        $resultados_blue = [
            ['kills' => 8, 'deaths' => 3, 'assists' => 3, 'champion_name' => 'aatrox'],
            ['kills' => 2, 'deaths' => 2, 'assists' => 16, 'champion_name' => 'rell'],
            ['kills' => 6, 'deaths' => 0, 'assists' => 13, 'champion_name' => 'orianna'],
            ['kills' => 4, 'deaths' => 1, 'assists' => 10, 'champion_name' => 'jhin'],
            ['kills' => 3, 'deaths' => 2, 'assists' => 15, 'champion_name' => 'bard']
        ];
        $game4->attachPlayers($resultados_blue, $resultados_red);

        //JDG t1 mapa 2

        $game5 = Game::create([
            'team_blue_id' => 4,
            'team_red_id' => 2,
            'serie_id' => 1,
            'number' => 2,
            'team_blue_result' => 'W',
            'team_red_result' => 'L']);

        $resultados_blue = [
            ['kills' => 5, 'deaths' => 0, 'assists' => 6, 'champion_name' => 'k\'sante'],
            ['kills' => 4, 'deaths' => 4, 'assists' => 8, 'champion_name' => 'vi'],
            ['kills' => 1, 'deaths' => 1, 'assists' => 15, 'champion_name' => 'Orianna'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 10, 'champion_name' => 'kalista'],
            ['kills' => 5, 'deaths' => 1, 'assists' => 15, 'champion_name' => 'senna']
        ];
        $resultados_red = [
            ['kills' => 2, 'deaths' => 3, 'assists' => 0, 'champion_name' => 'aatrox'],
            ['kills' => 1, 'deaths' => 7, 'assists' => 6, 'champion_name' => 'maokai'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 3, 'champion_name' => 'azir'],
            ['kills' => 2, 'deaths' => 3, 'assists' => 5, 'champion_name' => 'caitlyn'],
            ['kills' => 2, 'deaths' => 4, 'assists' => 5, 'champion_name' => 'ashe']
        ];
        $game5->attachPlayers($resultados_blue, $resultados_red);

        //JDG t1 mapa 3

        $game6 = Game::create([
            'team_blue_id' => 2,
            'team_red_id' => 4,
            'serie_id' => 1,
            'number' => 3,
            'team_blue_result' => 'W',
            'team_red_result' => 'L']);

        $resultados_red = [
            ['kills' => 1, 'deaths' => 4, 'assists' => 5, 'champion_name' => 'Renekton'],
            ['kills' => 2, 'deaths' => 4, 'assists' => 5, 'champion_name' => 'Wukong'],
            ['kills' => 2, 'deaths' => 2, 'assists' => 4, 'champion_name' => 'Taliyah'],
            ['kills' => 4, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'varus'],
            ['kills' => 1, 'deaths' => 5, 'assists' => 5, 'champion_name' => 'ashe']
        ];
        $resultados_blue = [
            ['kills' => 6, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'aatrox'],
            ['kills' => 2, 'deaths' => 3, 'assists' => 11, 'champion_name' => 'rell'],
            ['kills' => 3, 'deaths' => 1, 'assists' => 9, 'champion_name' => 'azir'],
            ['kills' => 4, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'kalista'],
            ['kills' => 3, 'deaths' => 1, 'assists' => 13, 'champion_name' => 'renata glasc']
        ];

        $game6->attachPlayers($resultados_blue, $resultados_red);

        //Jdg t1 mapa 4
        $game7 = Game::create([
            'team_blue_id' => 4,
            'team_red_id' => 2,
            'serie_id' => 1,
            'number' => 4,
            'team_blue_result' => 'L',
            'team_red_result' => 'W']);

        $resultados_blue = [
            ['kills' => 0, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'aatrox'],
            ['kills' => 2, 'deaths' => 6, 'assists' => 2, 'champion_name' => 'bel\'veth'],
            ['kills' => 0, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'orianna'],
            ['kills' => 4, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'zeri'],
            ['kills' => 0, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'lulu']
        ];

        $resultados_red = [
            ['kills' => 1, 'deaths' => 0, 'assists' => 4, 'champion_name' => 'yone'],
            ['kills' => 1, 'deaths' => 1, 'assists' => 14, 'champion_name' => 'jarvan iv'],
            ['kills' => 8, 'deaths' => 2, 'assists' => 3, 'champion_name' => 'azir'],
            ['kills' => 6, 'deaths' => 0, 'assists' => 4, 'champion_name' => 'varus'],
            ['kills' => 0, 'deaths' => 3, 'assists' => 13, 'champion_name' => 'bard']
        ];
        $game7->attachPlayers($resultados_blue, $resultados_red);
        //gen.g vs blg
    $game8 = Game::create([
        'team_blue_id' => 8,
        'team_red_id' => 6,
        'serie_id' => 6,
        'number' => 1,
        'team_blue_result' => 'L',
        'team_red_result' => 'W']);
    $resultados_blue = [
        ['kills' => 1, 'deaths' => 4, 'assists' => 0, 'champion_name' => 'jax'],
        ['kills' => 0, 'deaths' => 4, 'assists' => 3, 'champion_name' => 'rell'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 0, 'champion_name' => 'azir'],
        ['kills' => 2, 'deaths' => 3, 'assists' => 0, 'champion_name' => 'aphelios'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 3, 'champion_name' => 'tahm kench']
    ];
    $resultados_red = [
        ['kills' => 3, 'deaths' => 7, 'assists' => 5, 'champion_name' => 'aatrox'],
        ['kills' => 2, 'deaths' => 6, 'assists' => 4, 'champion_name' => 'jarvan iv'],
        ['kills' => 2, 'deaths' => 3, 'assists' => 3, 'champion_name' => 'orianna'],
        ['kills' => 1, 'deaths' => 2, 'assists' => 6, 'champion_name' => 'kalista'],
        ['kills' => 0, 'deaths' => 5, 'assists' => 4, 'champion_name' => 'renata glasc']
    ];

    $game8->attachPlayers($resultados_blue, $resultados_red);
    $game9 = Game::create([
        'team_blue_id' => 6,
        'team_red_id' => 8,
        'serie_id' => 6,
        'number' => 2,
        'team_blue_result' => 'W',
        'team_red_result' => 'L']);
    $resultados_blue = [
        ['kills' => 1, 'deaths' => 6, 'assists' => 0, 'champion_name' => 'aatrox'],
        ['kills' => 0, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'maokai'],
        ['kills' => 1, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'azir'],
        ['kills' => 1, 'deaths' => 1, 'assists' => 0, 'champion_name' => 'aphelios'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 2, 'champion_name' => 'milio']
    ];
    $resultados_red = [
        ['kills' => 2, 'deaths' => 2, 'assists' => 4, 'champion_name' => 'rumble'],
        ['kills' => 5, 'deaths' => 0, 'assists' => 8, 'champion_name' => 'jarvan iv'],
        ['kills' => 1, 'deaths' => 0, 'assists' => 3, 'champion_name' => 'orianna'],
        ['kills' => 7, 'deaths' => 0, 'assists' => 2, 'champion_name' => 'xayah'],
        ['kills' => 0, 'deaths' => 1, 'assists' => 12, 'champion_name' => 'renata glasc']
    ];

    $game9->attachPlayers($resultados_blue, $resultados_red);

    $game10 = Game::create([
        'team_blue_id' => 8,
        'team_red_id' => 6,
        'serie_id' => 6,
        'number' => 3,
        'team_blue_result' => 'W',
        'team_red_result' => 'L']);
    $resultados_blue = [
        ['kills' => 5, 'deaths' => 2, 'assists' => 6, 'champion_name' => 'aatrox'],
        ['kills' => 2, 'deaths' => 2, 'assists' => 9, 'champion_name' => 'maokai'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'yone'],
        ['kills' => 7, 'deaths' => 2, 'assists' => 3, 'champion_name' => 'kai\'sa'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 10, 'champion_name' => 'nautilus']
    ];
    $resultados_red = [
        ['kills' => 0, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'renekton'],
        ['kills' => 2, 'deaths' => 0, 'assists' => 5, 'champion_name' => 'jarvan iv'],
        ['kills' => 3, 'deaths' => 3, 'assists' => 5, 'champion_name' => 'orianna'],
        ['kills' => 4, 'deaths' => 4, 'assists' => 3, 'champion_name' => 'caitlyn'],
        ['kills' => 0, 'deaths' => 3, 'assists' => 4, 'champion_name' => 'braum']
    ];

    $game10->attachPlayers($resultados_blue, $resultados_red);
    $game11 = Game::create([
        'team_blue_id' => 6,
        'team_red_id' => 8,
        'serie_id' => 6,
        'number' => 4,
        'team_blue_result' => 'L',
        'team_red_result' => 'W']);
    $resultados_red = [
        ['kills' => 2, 'deaths' => 2, 'assists' => 15, 'champion_name' => 'rumble'],
        ['kills' => 6, 'deaths' => 2, 'assists' => 7, 'champion_name' => 'vi'],
        ['kills' => 5, 'deaths' => 2, 'assists' => 8, 'champion_name' => 'akali'],
        ['kills' => 6, 'deaths' => 3, 'assists' => 11, 'champion_name' => 'kalista'],
        ['kills' => 1, 'deaths' => 2, 'assists' => 17, 'champion_name' => 'rell']
    ];
    $resultados_blue = [
        ['kills' => 2, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'K\'sante'],
        ['kills' => 6, 'deaths' => 3, 'assists' => 4, 'champion_name' => 'jarvan iv'],
        ['kills' => 0, 'deaths' => 4, 'assists' => 7, 'champion_name' => 'neeko'],
        ['kills' => 3, 'deaths' => 4, 'assists' => 7, 'champion_name' => 'ashe'],
        ['kills' => 0, 'deaths' => 5, 'assists' => 8, 'champion_name' => 'tahm kench']
    ];

    $game11->attachPlayers($resultados_blue, $resultados_red);
    $game12 = Game::create([
        'team_blue_id' => 6,
        'team_red_id' => 8,
        'serie_id' => 6,
        'number' => 5,
        'team_blue_result' => 'W',
        'team_red_result' => 'L']);
    $resultados_blue = [
        ['kills' => 3, 'deaths' => 3, 'assists' => 8, 'champion_name' => 'rumble'],
        ['kills' => 5, 'deaths' => 1, 'assists' => 8, 'champion_name' => 'vi'],
        ['kills' => 3, 'deaths' => 1, 'assists' => 9, 'champion_name' => 'orianna'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 10, 'champion_name' => 'senna'],
        ['kills' => 1, 'deaths' => 0, 'assists' => 10, 'champion_name' => 'tahm kench']
    ];
    $resultados_red = [
        ['kills' => 0, 'deaths' => 3, 'assists' => 2, 'champion_name' => 'gnar'],
        ['kills' => 0, 'deaths' => 3, 'assists' => 6, 'champion_name' => 'vi'],
        ['kills' => 2, 'deaths' => 3, 'assists' => 1, 'champion_name' => 'akali'],
        ['kills' => 4, 'deaths' => 1, 'assists' => 1, 'champion_name' => 'kai\'sa'],
        ['kills' => 0, 'deaths' => 4, 'assists' => 4, 'champion_name' => 'rell']
    ];

    $game12->attachPlayers($resultados_blue, $resultados_red);
    //lng vs t1
    $game13 = Game::create([
        'team_blue_id' => 7,
        'team_red_id' => 2,
        'serie_id' => 8,
        'number' => 1,
        'team_blue_result' => 'L',
        'team_red_result' => 'W']);
    $resultados_blue = [
        ['kills' => 2, 'deaths' => 3, 'assists' => 0, 'champion_name' => 'gwen'],
        ['kills' => 0, 'deaths' => 4, 'assists' => 2, 'champion_name' => 'jarvan iv'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 0, 'champion_name' => 'azir'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 0, 'champion_name' => 'kai\'sa'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 0, 'champion_name' => 'blitzcrank']
    ];
    $resultados_red = [
        ['kills' => 5, 'deaths' => 1, 'assists' => 4, 'champion_name' => 'aatrox'],
        ['kills' => 0, 'deaths' => 0, 'assists' => 12, 'champion_name' => 'rell'],
        ['kills' => 3, 'deaths' => 0, 'assists' => 8, 'champion_name' => 'orianna'],
        ['kills' => 4, 'deaths' => 0, 'assists' => 6, 'champion_name' => 'nilah'],
        ['kills' => 1, 'deaths' => 1, 'assists' => 9, 'champion_name' => 'senna']
    ];

    $game13->attachPlayers($resultados_blue, $resultados_red);
    
    $game14 = Game::create([
        'team_blue_id' => 7,
        'team_red_id' => 2,
        'serie_id' => 8,
        'number' => 2,
        'team_blue_result' => 'L',
        'team_red_result' => 'W']);
    $resultados_blue = [
        ['kills' => 0, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'gwen'],
        ['kills' => 0, 'deaths' => 1, 'assists' => 2, 'champion_name' => 'maokai'],
        ['kills' => 1, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'jayce'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 0, 'champion_name' => 'aphelios'],
        ['kills' => 0, 'deaths' => 2, 'assists' => 2, 'champion_name' => 'rakan']
    ];
    $resultados_red = [
        ['kills' => 2, 'deaths' => 0, 'assists' => 3, 'champion_name' => 'aatrox'],
        ['kills' => 0, 'deaths' => 1, 'assists' => 8, 'champion_name' => 'rell'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 1, 'champion_name' => 'sylas'],
        ['kills' => 4, 'deaths' => 1, 'assists' => 3, 'champion_name' => 'varus'],
        ['kills' => 0, 'deaths' => 0, 'assists' => 3, 'champion_name' => 'ashe']
    ];

    $game14->attachPlayers($resultados_blue, $resultados_red);

    $game15 = Game::create([
        'team_blue_id' => 7,
        'team_red_id' => 2,
        'serie_id' => 8,
        'number' => 3,
        'team_blue_result' => 'L',
        'team_red_result' => 'W']);
    $resultados_blue = [
        ['kills' => 1, 'deaths' => 4, 'assists' => 0, 'champion_name' => 'renekton'],
        ['kills' => 0, 'deaths' => 5, 'assists' => 2, 'champion_name' => 'sejuani'],
        ['kills' => 1, 'deaths' => 2, 'assists' => 2, 'champion_name' => 'orianna'],
        ['kills' => 1, 'deaths' => 2, 'assists' => 1, 'champion_name' => 'aphelios'],
        ['kills' => 0, 'deaths' => 0, 'assists' => 2, 'champion_name' => 'milio']
    ];
    $resultados_red = [
        ['kills' => 6, 'deaths' => 0, 'assists' => 3, 'champion_name' => 'jayce'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 5, 'champion_name' => 'poppy'],
        ['kills' => 2, 'deaths' => 1, 'assists' => 7, 'champion_name' => 'azir'],
        ['kills' => 3, 'deaths' => 1, 'assists' => 3, 'champion_name' => 'varus'],
        ['kills' => 0, 'deaths' => 0, 'assists' => 7, 'champion_name' => 'renata glasc']
    ];

    $game15->attachPlayers($resultados_blue, $resultados_red);
    }

}
