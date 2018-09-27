<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the category table

        DB::table('category_tbls')->truncate();

        //generate category


        DB::table('category_tbls')->insert([
            [
                'category_name' => "Men",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Women",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Electronics",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Kids",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Girls",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Boys",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Optics",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Hand Watch",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Shoes",
                'category_description' => "Hello",
                'publication_status' => "1"
            ],[
                'category_name' => "Leather",
                'category_description' => "Hello",
                'publication_status' => "1"
            ]
        ]);

    }
}
