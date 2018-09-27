<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $owner = new Role();
        $admin = new Role();
        $user = new Role();
        $permissions = Permission::all();
        $o = 'owner';
        $a = 'super-admin';
        $u = 'user';

        DB::table('roles')->where('roles.name','=',$o)->delete();

            $owner->name = 'owner';
            $owner->display_name = 'Project Owner'; // optional
            $owner->description = 'User is the Owner of a given project'; // optional
            $owner->save();

        foreach ($permissions as $key=>$value) {
            $owner->attachPermission($value);
        }

        DB::table('roles')->where('roles.name','=',$a)->delete();

            $admin->name = 'super-admin';
            $admin->display_name = 'User Administrator'; // optional
            $admin->description = 'User is allowed to manage and edit other users'; // optional
            $admin->save();

        foreach ($permissions as $key=>$value) {
            $admin->attachPermission($value);
        }

        DB::table('roles')->where('roles.name','=',$u)->delete();

        $user->name = 'user';
        $user->display_name = 'd'; // optional
        $user->description = 'd'; // optional
        $user->save();

        foreach ($permissions as $key=>$value) {
            $user->attachPermission($value);
        }


//        $m_owner->attachPermission(Permission::all('id'));
//        $s_admin->attachPermission(Permission::all('id'));

    }
}
