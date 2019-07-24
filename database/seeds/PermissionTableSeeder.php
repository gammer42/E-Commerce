<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $permissions = [
            // <-- Admin Permission -->
            [
                'slug' => 'admin-read',
                'name' => 'Display Administrators Menu',
            ],
            [
                'slug' => 'admin-show',
                'name' => 'Display Administrators list',
            ],
            [
                'slug' => 'admin-create',
                'name' => 'Create New Administrator',
            ],
            [
                'slug' => 'admin-update',
                'name' => 'Update/Edit Administrator',
            ],
            [
                'slug' => 'admin-delete',
                'name' => 'Delete Administrator',
            ],
            // <-- Roles Permission -->
            [
                'slug' => 'role-read',
                'name' => 'Display Role menu',
            ],
            [
                'slug' => 'role-show',
                'name' => 'Display Role Details',
            ],
            [
                'slug' => 'role-create',
                'name' => 'Create New Role',
            ],
            [
                'slug' => 'role-update',
                'name' => 'Update/Edit Role',
            ],
            [
                'slug' => 'role-delete',
                'name' => 'Delete a Role',
            ],
            // <-- User Permission -->
            [
                'slug' => 'user-read',
                'name' => 'Display User Menu',
            ],
            [
                'slug' => 'user-show',
                'name' => 'Display user Details',
            ],
            [
                'slug' => 'user-create',
                'name' => 'Create New User',
            ],
            [
                'slug' => 'user-update',
                'name' => 'Update/Edit User',
            ],
            [
                'slug' => 'user-delete',
                'name' => 'Delete User',
            ],
            
        ];
        foreach ($permissions as $permission) {
            $check = 'check';
            $check = Permission::where('permissions.slug', $permission['slug'])->get();
            if ($check == '[]') {
                Permission::create($permission);
            }
        }
    }
}
