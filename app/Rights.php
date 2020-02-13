<?php


namespace App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use mysql_xdevapi\Table;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;
use phpDocumentor\Reflection\Types\This;

class Rights
{

    /*
     *      Stocke dans le cache l'id d'un utilisateur s'il n'est pas déjà enregistré
     * store_id($id) number
     * @return id
     */
    public static function store_id($id){
        if (Cache::has($id))
            return Cache::get($id);
        else {
            $get_id = User::select('id')->where('id', $id)->first()->id;
             Cache::put($id,$get_id,now()->addMinutes(10));
             return $get_id;
        }
    }

    /*
     *      Stocke dans le cache l'id de l'user identifié s'il n'est pas déjà enregistré
     * store_id()
     * @return id
     */
    public static function store_auth(){
        if (Cache::has('auth'))
            return Cache::get('auth');
        else {
             Cache::put('auth',Auth::user()->id,now()->addMinutes(10));
             return Auth::user()->id;
        }
    }

    /*
     *      Stocke dans le cache les nfos de l,user, ses rôles et ermissions s'il n'ont pas déjà enregistré
     * store_id($user_id) number
     * @return object
     */
    public static function get_roles_perms($user_id){
        if (Cache::has('role_perm'.$user_id))
            return Cache::get('role_perm'.$user_id);
        else {
            $roles_perms = User::with('roles.permissions')->find($user_id);
            Cache::put('role_perm'.$user_id,$roles_perms,now()->addMinutes(10));
            return $roles_perms;
        }
    }

    /*
     *      L'utilisateur d'id $user_id possède-t-il le rôle $role_name ?
     *
     * is($user_id, $role_name) // integer, string
     * @return boolean
     */
    public static function is($user_id, $role_name)
    {
        $my_roles = self::get_roles_perms($user_id);
        foreach ($my_roles->roles as $role)
            if ($role_name == $role->role) return true;
        return false;
    }

    /*
     *      L'utilisateur d'id $user_id a-t-il la permission $permission_name ?
     * can($user_id, $permission_name) // integer, string
     * @return boolean
     */
    public static function can($user_id,  $permission_name, $my_roles = null)
    {
        $my_roles = $my_roles?$my_roles:self::get_roles_perms($user_id);
        foreach ($my_roles->roles as $role){
            foreach ($role->permissions as $permission)
                if ($permission_name == $permission->permission) return true;
        }
        return false;
    }

    /*
     *      L'utilisateur d'id $user_id a-t-il toutes les permissions contenues dans le tableau $permissions_names ?
     *
     * canAll($user_id, $permissions_names) // integer, array
     * @return boolean
     */
    public static function canAll($user_id,  $permissions_names)
    {
        $perms = array();
        $my_roles = self::get_roles_perms($user_id);
        foreach ($permissions_names as $permissions_name)
            if (self::can($user_id,  $permissions_name, $my_roles))
                if (!in_array($permissions_name, $perms)) array_push($perms, $permissions_name);
        return count($perms) == count($permissions_names);
    }

    /*
     *      L'utilisateur d'id $user_id a-t-il au moins l'une des permissions contenues dans le tableau
       $permissions_names ?
     *
     * canAtLeast($user_id, $permissions_names) // integer, array
     * @return boolean
     */
    public static function canAtLeast($user_id,  $permissions_names)
    {
        $my_roles = self::get_roles_perms($user_id);
        foreach ($permissions_names as $permissions_name)
            if (self::can($user_id,  $permissions_name, $my_roles)) return true;
        return false;
    }

    /*
     * Mêmes fonctions avec l'utilisateur connécté
     */
    public static function authIs($role_name)
    {
        return self::is(self::store_auth(), $role_name);
    }

    public static function authCan($permission_name)
    {
        return self::can(self::store_auth(), $permission_name);
    }

    public static function authCanAll($permissions_names)
    {
        return self::canAll(self::store_auth(), $permissions_names);
    }

    public static function authCanAtLeast($permissions_names)
    {
        return self::canAtLeast(self::store_auth(), $permissions_names);
    }
}
