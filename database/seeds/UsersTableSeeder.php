<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    const ROLE_USER = 1;
    const ROLE_RESP = 2;
    const ROLE_ADMIN = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => self::ROLE_USER,
            'password' => bcrypt('user')
        ]);
/*        DB::table('users')->insert([
            'name' => 'resp',
            'email' => 'resp@gmail.com',
            'role' => self::ROLE_RESP,
            'password' => bcrypt('resp')
        ]);*/
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => self::ROLE_ADMIN,
            'password' => bcrypt('admin')
        ]);

        factory(\App\User::class,100)->create();
    }
}
