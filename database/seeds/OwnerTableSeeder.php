<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $m_owner = Role::where('name', 'owner')->first();
        $s_admin = Role::where('name', 'super-admin')->first();

        // attach role

        $ownerUser = User::where('email', 'owner@gmail.com')->first();
        if(!$ownerUser->hasRole('owner')) {
            $ownerUser->attachRole($m_owner);
        }

        $adminUser = User::where('email', 'super-admin@gmail.com')->first();
        if(!$adminUser->hasRole('super-admin')) {
            $adminUser->attachRole($s_admin);
        }
    }
}
