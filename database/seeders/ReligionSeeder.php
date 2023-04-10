<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->delete();
        $religion = array(
            array("name_ka"=>"მართლმადიდებელი-ქრისტიანი","name_ru"=>"Православная христианская","name_en"=>"Orthodox Christian"),
            array("name_ka"=>"მუსულმანი","name_ru"=>"Мусульманин","name_en"=>"Muslim"),
            array("name_ka"=>"ბუდისტი","name_ru"=>"Буддист","name_en"=>"Buddhist"),
            array("name_ka"=>"იუდეველი","name_ru"=>"Иудей","name_en"=>"Jew"),
            array("name_ka"=>"პროტესტანტული","name_ru"=>"Протестантский","name_en"=>"Protestant"),
            array("name_ka"=>"კათოლიკე-ქრისტაინი","name_ru"=>"Католик-христианин","name_en"=>"Catholic-Christian"),
            array("name_ka"=>"მზეთთაყვანისმცემელი","name_ru"=>"Солнцепоклонник","name_en"=>"Sun worshiper"),
            array("name_ka"=>"იეჰოვას მოწმე","name_ru"=>"Свидетель Иеговы","name_en"=>"Jehovah's Witness"),
            array("name_ka"=>"გრიგორიანელი-ქრისტიანი","name_ru"=>"Григорианско-христианский","name_en"=>"Gregorian-Christian"),
            array("name_ka"=>"სხვა...","name_ru"=>"Другой...","name_en"=>"other..."),
        );
        DB::table('religions')->insert($religion);
    }
}
