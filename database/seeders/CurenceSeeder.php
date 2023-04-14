<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();
        $data = array(
            array("name_ka"=>"ლარი","name_ru"=>"Лари","name_en"=>"Lari","icon"=>"₾"),
            array("name_ka"=>"დოლარი","name_ru"=>"доллар","name_en"=>"Dollar","icon"=>"$"),
            array("name_ka"=>"ევრო","name_ru"=>"евро","name_en"=>"Euro","icon"=>"€"),
        );
        DB::table('currencies')->insert($data);
    }
}
