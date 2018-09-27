<?php

use Illuminate\Database\Seeder;

class ManufactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset the Manufacture table

        DB::table('manufactures')->truncate();

        //Generate Category
        DB::table('manufactures')->insert([
            [
                'manufacture_name' => "Aarong",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Cats Eye",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Richman ",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Yellow ",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Ecstasy ",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Rang ",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Kay Kraft",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Dorjibari",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Anjan’s",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Bibiana",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Fortuna Leather",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Apex",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Sky Sea",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Vivrant",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Vintage",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],[
                'manufacture_name' => "Nike",
                'manufacture_description' => "manufacture_description",
                'publication_status' => 1
            ],
        ]);
    }
}
