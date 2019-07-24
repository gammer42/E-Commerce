<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $dev_role = Role::where('slug','developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $developer = new User();
        $developer->name = 'Usama Muneer';
        $developer->email = 'admin@test.com';
        $developer->phone = 5465465354;
        $developer->upazila_id = 5;
        $developer->address = $faker->address;
        $developer->job_title = $faker->title;
        $developer->dob = $faker->date;
        $developer->blood_group = 'O+';
        $developer->join_date = $faker->date;
        $developer->salary = rand(5,6);
        $developer->nid = rand(15,16);
        $developer->is_access = $faker->boolean();
        $developer->password = Hash::make('123456');
        $developer->save();
        $developer->roles()->attach($dev_role);


        $manager = new User();
        $manager->name = 'Asad Butt';
        $manager->email = 'me@test.com';
        $manager->phone = 5465465324;
        $manager->upazila_id = 5;
        $manager->address = $faker->address;
        $manager->job_title = $faker->title;
        $manager->dob = $faker->date;
        $manager->blood_group = 'O+';
        $manager->join_date = $faker->date;
        $manager->salary = rand(5,6);
        $manager->nid = rand(15,16);
        $manager->is_access = $faker->boolean();
        $manager->password = Hash::make('123456');
        $manager->save();
        $manager->roles()->attach($manager_role);
    }
}
