<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

            // <-- Rolling Permission -->

            [
                'name' => 'role-read',
                'display_name' => 'Display Role menu',
                'description' => 'See Role menu Permission'
            ],
            [
                'name' => 'role-show',
                'display_name' => 'Display Role Details',
                'description' => 'Display Role in table Permission'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create New Role',
                'description' => 'Create a New Role Permission'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Update/Edit Role',
                'description' => 'Update/Edit Role Permission'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete a Role',
                'description' => 'Delete a Role Permission'
            ],

            // <-- User Permission -->

            [
                'name' => 'user-read',
                'display_name' => 'Display User Menu',
                'description' => 'Display User Menu Permission'
            ],
            [
                'name' => 'user-show',
                'display_name' => 'Display user Details',
                'description' => 'Display user Permission'
            ],
            [
                'name' => 'user-create',
                'display_name' => 'Create New User',
                'description' => 'Create New User Permission'
            ],
            [
                'name' => 'user-edit',
                'display_name' => 'Update/Edit User',
                'description' => 'Update/Edit User Permission'
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Delete User',
                'description' => 'Delete User Permission'
            ],

            // <-- Admin Permission -->

            [

                'name' => 'admin-read',
                'display_name' => 'Display Administrators Menu',
                'description' => 'Display Administrators Menu Permission'
            ],
            [
                'name' => 'admin-show',
                'display_name' => 'Display Administrators list',
                'description' => 'Display Administrators list Permission'
            ],
            [
                'name' => 'admin-create',
                'display_name' => 'Create New Administrator',
                'description' => 'Create New Administrator Permission'
            ],
            [
                'name' => 'admin-edit',
                'display_name' => 'Update/Edit Administrator',
                'description' => 'Update/Edit Administrator Permission'
            ],
            [
                'name' => 'admin-delete',
                'display_name' => 'Delete Administrator',
                'description' => 'Delete Administrator Permission'
            ],

            // <-- Message Permission -->

            [

                'name' => 'message-read',
                'display_name' => 'Display Message Menu',
                'description' => 'Display Message Menu Permission'
            ],
            [
                'name' => 'message-show',
                'display_name' => 'Display Message list',
                'description' => 'Display Message list Permission'
            ],
            [
                'name' => 'message-create',
                'display_name' => 'Create New Message',
                'description' => 'Create New Message Permission'
            ],
            [
                'name' => 'message-edit',
                'display_name' => 'Update/Edit Message',
                'description' => 'Update/Edit Message Permission'
            ],
            [
                'name' => 'message-delete',
                'display_name' => 'Delete Message',
                'description' => 'Delete Message Permission'
            ],

            // <-- Category Permission -->

            [

                'name' => 'category-read',
                'display_name' => 'Display Category Menu',
                'description' => 'Display Category Menu Permission'
            ],
            [
                'name' => 'category-show',
                'display_name' => 'Display Category list',
                'description' => 'Display Category list Permission'
            ],
            [
                'name' => 'category-create',
                'display_name' => 'Create New Category',
                'description' => 'Create New Category Permission'
            ],
            [
                'name' => 'category-edit',
                'display_name' => 'Update/Edit Category',
                'description' => 'Update/Edit Category Permission'
            ],
            [
                'name' => 'category-delete',
                'display_name' => 'Delete Category',
                'description' => 'Delete Category Permission'
            ],

            // <-- Article Permission -->

            [

                'name' => 'article-read',
                'display_name' => 'Display Article Menu',
                'description' => 'Display Article Menu Permission'
            ],
            [
                'name' => 'article-show',
                'display_name' => 'Display Article list',
                'description' => 'Display Article list Permission'
            ],
            [
                'name' => 'article-create',
                'display_name' => 'Create New Article',
                'description' => 'Create New Article Permission'
            ],
            [
                'name' => 'article-edit',
                'display_name' => 'Update/Edit Article',
                'description' => 'Update/Edit Article Permission'
            ],
            [
                'name' => 'article-delete',
                'display_name' => 'Delete Article',
                'description' => 'Delete Article Permission'
            ],

            // <-- Plant Permission -->

            [

                'name' => 'plant-read',
                'display_name' => 'Display Plant Menu',
                'description' => 'Display Plant Menu Permission'
            ],
            [
                'name' => 'plant-show',
                'display_name' => 'Display Plant list',
                'description' => 'Display Plant list Permission'
            ],
            [
                'name' => 'plant-create',
                'display_name' => 'Create New Plant',
                'description' => 'Create New Plant Permission'
            ],
            [
                'name' => 'plant-edit',
                'display_name' => 'Update/Edit Plant',
                'description' => 'Update/Edit Plant Permission'
            ],
            [
                'name' => 'plant-delete',
                'display_name' => 'Delete Plant',
                'description' => 'Delete Plant Permission'
            ],

            // <-- Blog Permission -->

            [

                'name' => 'blog-read',
                'display_name' => 'Display Blog Menu',
                'description' => 'Display Blog Menu Permission'
            ],
            [
                'name' => 'blog-show',
                'display_name' => 'Display Blog list',
                'description' => 'Display Blog list Permission'
            ],
            [
                'name' => 'blog-create',
                'display_name' => 'Create New Blog',
                'description' => 'Create New Blog Permission'
            ],
            [
                'name' => 'blog-edit',
                'display_name' => 'Update/Edit Blog',
                'description' => 'Update/Edit Blog Permission'
            ],
            [
                'name' => 'blog-delete',
                'display_name' => 'Delete Blog',
                'description' => 'Delete Blog Permission'
            ],


        ];

        foreach ($permissions as $permission){
            $per = DB::table('permissions')->where('permissions.name', $permission['name'])->get();
            if($per == '[]')
            Permission::create($permission);
        }
    }
}
