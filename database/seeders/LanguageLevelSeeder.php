<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('language_levels')->delete();
        $data = array(
            array("name_ka"=>"მშობლიური","name_en"=>"","name_ru"=>""),
            array("name_ka"=>"კარგი","name_en"=>"","name_ru"=>""),
            array("name_ka"=>"საშუალო","name_en"=>"","name_ru"=>""),
            array("name_ka"=>"ცუდი","name_en"=>"","name_ru"=>""),
        );
        DB::table('language_levels')->insert($data );
    }
}
