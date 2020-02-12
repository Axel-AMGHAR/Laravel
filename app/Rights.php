<?php


namespace App;
use Illuminate\Support\Facades\DB;

use mysql_xdevapi\Table;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;
use phpDocumentor\Reflection\Types\This;

class Rights
{
    /*
     *      L'utilisateur d'id $user_id possède-t-il le rôle $role_name ?
     *
     * is($user_id, $role_name) // integer, string
     * @return boolean
     */
    public static function is($user_id, $role_name)
    {
        $my_roles = User::with('roles')->find($user_id);
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
        $my_roles = $my_roles?$my_roles:User::with('roles.permissions')->find($user_id);
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
        $my_roles = User::with('roles.permissions')->find($user_id);
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
        $my_roles = User::with('roles.permissions')->find($user_id);
        foreach ($permissions_names as $permissions_name)
            if (self::can($user_id,  $permissions_name, $my_roles)) return true;
        return false;
    }

    /*
     * Mêmes fonctions avec l'utilisateur connécté
     */
    public static function authIs($role_name)
    {
        return self::is(Auth::user()->id, $role_name);
    }

    public static function authCan($permission_name)
    {
        return self::can(Auth::user()->id, $permission_name);
    }

    public static function authCanAll($permissions_names)
    {
        return self::canAll(Auth::user()->id, $permissions_names);
    }

    public static function authCanAtLeast($permissions_names)
    {
        return self::canAtLeast(Auth::user()->id, $permissions_names);
    }
}
