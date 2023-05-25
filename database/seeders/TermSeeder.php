<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->delete();
        $data = array(
            array("name_ka"=>"მინიმუმ 1 წლით","name_en"=>"for at least 1 year","name_ru"=>"не менее 1 года"),
            array("name_ka"=>"6 თვით","name_en"=>"6 months","name_ru"=>"6 месяцев"),
            array("name_ka"=>"5 თვით","name_en"=>"5 months","name_ru"=>"5 месяцев"),
            array("name_ka"=>"4 თვით","name_en"=>"4 months","name_ru"=>"4 месяца"),
            array("name_ka"=>"3 თვით","name_en"=>"3 months","name_ru"=>"3 месяца"),
            array("name_ka"=>"2 თვით","name_en"=>"2 months","name_ru"=>"2 месяца"),
            array("name_ka"=>"1 თვით","name_en"=>"1 month","name_ru"=>"1 месяц"),
            array("name_ka"=>"3 კვირით","name_en"=>"for 3 weeks","name_ru"=>"на 3 недели"),
            array("name_ka"=>"2 კვირით","name_en"=>"for 2 weeks","name_ru"=>"на 2 недели"),
            array("name_ka"=>"1 კვირით","name_en"=>"for 1 week","name_ru"=>"на 1 неделю"),
            array("name_ka"=>"5 დღით","name_en"=>"for 5 days","name_ru"=>"на 5 дней"),
            array("name_ka"=>"3 დღით","name_en"=>"for 3 days","name_ru"=>"на 3 дня"),
            array("name_ka"=>"1 დღით","name_en"=>"for 1 day","name_ru"=>"на 1 день"),
        );
        DB::table('terms')->insert($data);
    }
}
