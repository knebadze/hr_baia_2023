<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();
        $data = array(
            array("status_type_id"=>"1", "name_ka"=>"საწყისი","name_en"=>"","name_ru"=>"", "color" => "primary"),
            array("status_type_id"=>"1", "name_ka"=>"წარომებაში","name_en"=>"","name_ru"=>"", "color" => "warning"),
            array("status_type_id"=>"1", "name_ka"=>"დაკავდა","name_en"=>"","name_ru"=>"", "color" => "lime"),
            array("status_type_id"=>"1", "name_ka"=>"დასრულდა","name_en"=>"","name_ru"=>"", "color" => "success"),
            array("status_type_id"=>"1", "name_ka"=>"გაუქმდა","name_en"=>"","name_ru"=>"", "color" => "secondary"),
            array("status_type_id"=>"1", "name_ka"=>"უნდა კადრი","name_en"=>"","name_ru"=>"", "color" => "indigo"),
            array("status_type_id"=>"1", "name_ka"=>"შეჩერებული","name_en"=>"","name_ru"=>"", "color" => "danger"),
            array("status_type_id"=>"2", "name_ka"=>"შევსების პროცესში","name_en"=>"","name_ru"=>" ", "color" => "warning"),
            array("status_type_id"=>"2", "name_ka"=>"თავისუფალი","name_en"=>"","name_ru"=>"", "color" => "primary"),
            array("status_type_id"=>"2", "name_ka"=>"მუდმივიად დასაქმებელი","name_en"=>"","name_ru"=>"", "color" => "success"),
            array("status_type_id"=>"2", "name_ka"=>"პერიოდულად დასაქმებელი","name_en"=>"","name_ru"=>"", "color" => "info"),
            array("status_type_id"=>"2", "name_ka"=>"შავ სიაში","name_en"=>"","name_ru"=>"", "color" => "black"),
            array("status_type_id"=>"1", "name_ka"=>"ვადა ამოიწურა","name_en"=>"","name_ru"=>"", "color" => "olive"),
        );
        DB::table('statuses')->insert($data);
    }
}
