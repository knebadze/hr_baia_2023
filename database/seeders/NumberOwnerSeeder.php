<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NumberOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('number_owners')->delete();
        $owner = array(
            array("name_ka"=>"პირადი","name_ru"=>"Личный","name_en"=>"Personal"),
            array("name_ka"=>"მეუღლე","name_ru"=>"Жена/Муж","name_en"=>"Wife/husband"),
            array("name_ka"=>"შვილი","name_ru"=>"Сын/Дочь","name_en"=>"Son/daughter"),
            array("name_ka"=>"დედა","name_ru"=>"Мать","name_en"=>"Mother"),
            array("name_ka"=>"მამა","name_ru"=>"Отец","name_en"=>"Father"),
            array("name_ka"=>"დედამთილი","name_ru"=>"Свекровь","name_en"=>"Mother in law"),
            array("name_ka"=>"მამამთილი","name_ru"=>"Свекр","name_en"=>"Father in law"),
            array("name_ka"=>"სიდედრი","name_ru"=>"Теща","name_en"=>"Sister in law"),
            array("name_ka"=>"სიმამრი","name_ru"=>"Тесть","name_en"=>"Father in law"),
            array("name_ka"=>"და","name_ru"=>"Сестра","name_en"=>"Sister"),
            array("name_ka"=>"ძმა","name_ru"=>"Брат","name_en"=>"Brother"),
            array("name_ka"=>"მეზობელი","name_ru"=>"Сосед","name_en"=>"Neighbor"),
            array("name_ka"=>"მეგობარი","name_ru"=>"Друг","name_en"=>"Friend"),
            array("name_ka"=>"ნათესავი","name_ru"=>"Родственник","name_en"=>"Relative"),
            array("name_ka"=>"სიძე","name_ru"=>"Зять","name_en"=>"Son-in-law"),
            array("name_ka"=>"რძალი","name_ru"=>"Невестка","name_en"=>"Daughter-in-law"),
            array("name_ka"=>"სხვა...","name_ru"=>"Другой...","name_en"=>"Other..."),
        );
        DB::table('number_owners')->insert($owner);
    }
}
