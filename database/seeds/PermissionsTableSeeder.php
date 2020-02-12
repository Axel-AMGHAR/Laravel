<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idUser1 = DB::table('users')->insertGetId([
            'name' => 'Axel',
            'email' => 'axel.amghar@gmail.com',
            'password' => bcrypt('test'),
        ]);
        $idUser2 = DB::table('users')->insertGetId([
            'name' => 'Axel2',
            'email' => 'axel.amghar2@gmail.com',
            'password' => bcrypt('test'),
        ]);
        $idUser3 = DB::table('users')->insertGetId([
            'name' => 'Axel3',
            'email' => 'axel.amghar3@gmail.com',
            'password' => bcrypt('test'),
        ]);

        $idAdmin = DB::table('roles')->insertGetId([
            'role' => 'admin',
        ]);
        $idResp = DB::table('roles')->insertGetId([
            'role' => 'responsable',
        ]);

        $idPerm1 = DB::table('permissions')->insertGetId([
            'permission' => 'add.user',
        ]);

        $idPerm2 =DB::table('permissions')->insertGetId([
            'permission' => 'del.user',
        ]);
        $idPerm3 =DB::table('permissions')->insertGetId([
            'permission' => 'add.structure',
        ]);

        $idPerm4 =DB::table('permissions')->insertGetId([
            'permission' => 'del.structure',
        ]);

        DB::table('permission_role')->insert([
            'role_id' => $idAdmin,
            'permission_id' => $idPerm1,
        ]);
        DB::table('permission_role')->insert([
            'role_id' => $idAdmin,
            'permission_id' => $idPerm2,
        ]);
        DB::table('permission_role')->insert([
            'role_id' => $idResp,
            'permission_id' => $idPerm3,
        ]);
        DB::table('permission_role')->insert([
            'role_id' => $idResp,
            'permission_id' => $idPerm4,
        ]);

        DB::table('role_user')->insert([
            'user_id' => $idUser1,
            'role_id' => $idAdmin,
        ]);

        DB::table('role_user')->insert([
            'user_id' => $idUser1,
            'role_id' => $idResp,
        ]);

        DB::table('role_user')->insert([
            'user_id' => $idUser2,
            'role_id' => $idAdmin,
        ]);

        DB::table('role_user')->insert([
            'user_id' => $idUser3,
            'role_id' => $idResp,
        ]);


    }
}
