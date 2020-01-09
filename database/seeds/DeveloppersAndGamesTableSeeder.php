<?php

use Illuminate\Database\Seeder;

class DeveloppersAndGamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

        public function run()
        {
            $idGearBox = DB::table('developpers')->insertGetId([
                'name' => 'Gearbox',
            ]);
            $idUbisoft = DB::table('developpers')->insertGetId([
                'name' => 'Ubisoft',
            ]);
            $idRiotGames = DB::table('developpers')->insertGetId([
                'name' => 'Riot Games',
            ]);
            $idMojang = DB::table('developpers')->insertGetId([
                'name' => 'Mojang',
            ]);

            $idLeagueOfLegends = DB::table('games')->insertGetId([
                'name' => 'League Of Legends',
                'developper_id' => $idRiotGames
            ]);
            $idAssassinsCreed = DB::table('games')->insertGetId([
                'name' => 'Assassin\'s Creed Ragnarok',
                'developper_id' => $idUbisoft
            ]);
            $idMinecraft = DB::table('games')->insertGetId([
                'name' => 'Minecraft',
                'developper_id' => $idMojang
            ]);
            $idBorderlands3 = DB::table('games')->insertGetId([
                'name' => 'Borderlands 3',
                'developper_id' => $idGearBox
            ]);

            for ($i = 0; $i < 3; $i++) {
                DB::table('game_platform')->insert([
                    'game_id' => $idMinecraft,
                    'platform_id' => $i
                ]);
            }
            for ($i = 0; $i < 3; $i++) {
                DB::table('game_platform')->insert([
                    'game_id' => $idAssassinsCreed,
                    'platform_id' => $i
                ]);
            }
            for ($i = 0; $i < 3; $i++) {
                DB::table('game_platform')->insert([
                    'game_id' => $idBorderlands3,
                    'platform_id' => $i
                ]);
            }
            DB::table('game_platform')->insert([
                'game_id' => $idLeagueOfLegends,
                'platform_id' => 1
            ]);
        }
}
