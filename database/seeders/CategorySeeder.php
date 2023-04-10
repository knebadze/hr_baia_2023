<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $category = array(
            array("name_ka"=>"ძიძა","name_en"=>"Babysitter","name_ru"=>"Няня"),
            array("name_ka"=>"გუვერნანტი","name_en"=>"Governess","name_ru"=>"Гувернантка"),
            array("name_ka"=>"რეპეტიტორი","name_en"=>"Tutor","name_ru"=>"Репетитор"),
            array("name_ka"=>"ოჯახში დამხმარე","name_en"=>"Helper in the family","name_ru"=>"Домработница"),
            array("name_ka"=>"ავადმყოფის მომვლელი","name_en"=>"Caregiver of the sick","name_ru"=>"Сиделька"),
            array("name_ka"=>"დამლაგებელი","name_en"=>"Cleaner","name_ru"=>"Уборшица"),
            array("name_ka"=>"მძღოლი","name_en"=>"Driver","name_ru"=>"Водитель"),
            array("name_ka"=>"საბავშვო ბაღის აღმზრდელი","name_en"=>"Kindergarten teacher","name_ru"=>"Воспитательница детского сада"),
            array("name_ka"=>"მზარეული","name_en"=>"Cook","name_ru"=>"Повар"),
        );
        DB::table('categories')->insert($category);
    }
}
