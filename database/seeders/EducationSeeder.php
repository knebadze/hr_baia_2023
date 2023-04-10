<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('education')->delete();
        $education = array(
            array("name_ka"=>"უმაღლესი","name_ru"=>"Высшее","name_en"=>"higher"),
            array("name_ka"=>"საშუალო","name_ru"=>"Среднее","name_en"=>"average"),
            array("name_ka"=>"ტექნიკური","name_ru"=>"Техническое","name_en"=>"technical"),
            array("name_ka"=>"პროფესიული","name_ru"=>"Профессиональное","name_en"=>"Professional"),
            array("name_ka"=>"არასრული უმაღლესი","name_ru"=>"Неполное высшее","name_en"=>"incomplete higher"),
            array("name_ka"=>"არასრული საშუალო","name_ru"=>"Неполная средняя","name_en"=>"incomplete average"),
            array("name_ka"=>"სტუდენტი/მაგისტრი","name_ru"=>"Студент/магистр","name_en"=>"student/master"),
        );
        DB::table('education')->insert($education);
    }
}
