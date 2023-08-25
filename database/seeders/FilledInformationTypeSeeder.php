<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FilledInformationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filled_information_types')->delete();
        $data = array(
            array("name_ka"=>"პერსონალური ინფორმაცია","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"უცხო ენები","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"ზოგადი სამუშაო გამოცდილება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"დამატებითი ნომრები","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"დოკუმენტაცია","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"სამუშაო ინფორმაცია","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"ოჯახში მუშაობის გამოცდილება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"რეკომენდაცია","name_ru"=>"","name_en"=>""),
        );
        DB::table('filled_information_types')->insert($data);
    }
}
