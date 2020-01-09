<?php

use Illuminate\Database\Seeder;

class PlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platforms')->insert([
           'name' => 'PC'
        ]);

        DB::table('platforms')->insert([
            'name' => 'PS4'
        ]);

        DB::table('platforms')->insert([
            'name' => 'PSP'
        ]);
    }
}
