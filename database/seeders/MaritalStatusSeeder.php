<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_statuses')->delete();
        $marital = array(
            array("name_ka"=>"დასაოჯახებელი","name_en"=>"single","name_ru"=>"Не женат / не замужем" ),
            array("name_ka"=>"დაოჯახებული","name_en"=>"Married" ,"name_ru"=>"Женат / замужем"),
            array("name_ka"=>"განქორწინებული","name_en"=>"Divorced","name_ru"=>"Разведен(а)"),
            array("name_ka"=>"ქვრივი","name_en"=>"Widow","name_ru"=>"Вдова(-ец)"),
        );
        DB::table('marital_statuses')->insert($marital);
    }
}
