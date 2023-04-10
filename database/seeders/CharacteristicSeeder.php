<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_characteristics')->delete();
        $characteristic = array(
            array("name_ka"=>"აქტიური/ენერგიული","name_ru"=>"Активный / энергичный","name_en"=>"active/energetic"),
            array("name_ka"=>"ხალისიანი","name_ru"=>"Жизнерадостный","name_en"=>"cheerful"),
            array("name_ka"=>"თბილი","name_ru"=>"Теплый","name_en"=>"warm"),
            array("name_ka"=>"ვიზუალურად მოწესრიგებული","name_ru"=>"Визуально упорядоченний","name_en"=>"Visually organized"),
            array("name_ka"=>"ღონიერი/ძლიერი","name_ru"=>"Сильный","name_en"=>"strong/strong"),
            array("name_ka"=>"ერუდირებული/ინტელექტუალური","name_ru"=>"эрудированный/интеллектуальный","name_en"=>"erudite/intellectual"),
            array("name_ka"=>"სპორტული აღნაგობის","name_ru"=>"Спортивного телосложения","name_en"=>"Sporty build"),
        );
        DB::table('general_characteristics')->insert($characteristic);
    }
}
