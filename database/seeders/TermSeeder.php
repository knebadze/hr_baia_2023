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
            array("name_ka"=>"მინიმუმ 1 წლით","name_en"=>"for at least 1 year","name_ru"=>"не менее 1 года", 'number' => 1, 'type' => 'Y'),
            array("name_ka"=>"6 თვით","name_en"=>"6 months","name_ru"=>"6 месяцев", 'number' => 6, 'type' => 'M'),
            array("name_ka"=>"5 თვით","name_en"=>"5 months","name_ru"=>"5 месяцев", 'number' => 5, 'type' => 'M'),
            array("name_ka"=>"4 თვით","name_en"=>"4 months","name_ru"=>"4 месяца", 'number' => 4, 'type' => 'M'),
            array("name_ka"=>"3 თვით","name_en"=>"3 months","name_ru"=>"3 месяца", 'number' => 3, 'type' => 'M'),
            array("name_ka"=>"2 თვით","name_en"=>"2 months","name_ru"=>"2 месяца", 'number' => 2, 'type' => 'M'),
            array("name_ka"=>"1 თვით","name_en"=>"1 month","name_ru"=>"1 месяц", 'number' => 1, 'type' => 'M'),
            array("name_ka"=>"3 კვირით","name_en"=>"for 3 weeks","name_ru"=>"на 3 недели", 'number' => 3, 'type' => 'W'),
            array("name_ka"=>"2 კვირით","name_en"=>"for 2 weeks","name_ru"=>"на 2 недели", 'number' => 2, 'type' => 'W'),
            array("name_ka"=>"1 კვირით","name_en"=>"for 1 week","name_ru"=>"на 1 неделю", 'number' => 1, 'type' => 'W'),
            array("name_ka"=>"5 დღით","name_en"=>"for 5 days","name_ru"=>"на 5 дней", 'number' => 5, 'type' => 'D'),
            array("name_ka"=>"3 დღით","name_en"=>"for 3 days","name_ru"=>"на 3 дня", 'number' => 3, 'type' => 'D'),
            array("name_ka"=>"1 დღით","name_en"=>"for 1 day","name_ru"=>"на 1 день", 'number' => 1, 'type' => 'D'),
        );
        DB::table('terms')->insert($data);
    }
}
