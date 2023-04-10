<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_experiences')->delete();
        $data = array(
            array("name_ka"=>"6 თვე","name_ru"=>"6 месяцев","name_en"=>"6 month"),
            array("name_ka"=>"1 წელი","name_ru"=>"1 год","name_en"=>"1 year"),
            array("name_ka"=>"2 წელი","name_ru"=>"2 года","name_en"=>"2 years"),
            array("name_ka"=>"3 წელი","name_ru"=>"3 года","name_en"=>"3 years"),
            array("name_ka"=>"4 წელი","name_ru"=>"4 года","name_en"=>"4 years"),
            array("name_ka"=>"5 წელი","name_ru"=>"5 лет","name_en"=>"5 years"),
            array("name_ka"=>"6 წელი","name_ru"=>"6 лет","name_en"=>"6 years"),
            array("name_ka"=>"7 წელი","name_ru"=>"7 лет","name_en"=>"7 years"),
            array("name_ka"=>"8 წელი","name_ru"=>"8 лет","name_en"=>"8 years"),
            array("name_ka"=>"9 წელი","name_ru"=>"9 лет","name_en"=>"9 years"),
            array("name_ka"=>"10 წელი","name_ru"=>"10 лет","name_en"=>"10 years"),
            array("name_ka"=>"11 წელი","name_ru"=>"11 лет","name_en"=>"11 years"),
            array("name_ka"=>"12 წელი","name_ru"=>"12 лет","name_en"=>"12 years"),
            array("name_ka"=>"13 წელი","name_ru"=>"13 лет","name_en"=>"13 years"),
            array("name_ka"=>"14 წელი","name_ru"=>"14 лет","name_en"=>"14 years"),
            array("name_ka"=>"15 წელი","name_ru"=>"15 лет","name_en"=>"15 years"),
            array("name_ka"=>"16 წელი","name_ru"=>"16 лет","name_en"=>"16 years"),
            array("name_ka"=>"17 წელი","name_ru"=>"17 лет","name_en"=>"17 years"),
            array("name_ka"=>"18 წელი","name_ru"=>"18 лет","name_en"=>"18 years"),
            array("name_ka"=>"19 წელი","name_ru"=>"19 лет","name_en"=>"19 years"),
            array("name_ka"=>"20 წელი","name_ru"=>"20 лет","name_en"=>"20 years"),
            array("name_ka"=>"მხოლოდ საკუთარ ოჯახში","name_ru"=>"Только в своей семье","name_en"=>"Only in your own family"),
        );
        DB::table('work_experiences')->insert($data);
    }
}
