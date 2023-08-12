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
            array("status_type_id"=>"1", "name_ka"=>"საწყისი","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"1", "name_ka"=>"წარომებაში","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"1", "name_ka"=>"დაკავდა","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"1", "name_ka"=>"დასრულდა","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"1", "name_ka"=>"გაუქმდა","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"1", "name_ka"=>"უნდა კადრი","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"1", "name_ka"=>"შეჩერებული","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"2", "name_ka"=>"შევსების პროცესში","name_en"=>" ","name_ru"=>"  "),
            array("status_type_id"=>"2", "name_ka"=>"დასასაქმებელი","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"2", "name_ka"=>"დასაქმებელი","name_en"=>"","name_ru"=>""),
            array("status_type_id"=>"2", "name_ka"=>"შავ სიაში","name_en"=>"","name_ru"=>""),
        );
        DB::table('statuses')->insert($data);
    }
}
