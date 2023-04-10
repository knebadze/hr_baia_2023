<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $gender = array(
            array("name_ka"=>"კაცი","name_en"=>"male","name_ru"=>"мужчина"),
            array("name_ka"=>"ქალი","name_en"=>"female","name_ru"=>"женщина"),
        );
        DB::table('genders')->insert($gender);
    }
}
