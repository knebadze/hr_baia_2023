<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->delete();
        $notice = array(
            array("name_ka"=>"ჯანმრთელობის მდგომარეობის შესახებ","name_ru"=>"О состоянии здоровья","name_en"=>"About the state of health"),
            array("name_ka"=>"ნასამართლეობის შესახებ","name_ru"=>"О судимости","name_en"=>"About the conviction"),
            array("name_ka"=>"რეკომენდაცია","name_ru"=>"Рекомендация","name_en"=>"recommendation"),
            array("name_ka"=>"პირადობის მოწმობა","name_ru"=>"Удостоверение личности","name_en"=>"ID card"),
            array("name_ka"=>"განათლების მოწმობა","name_ru"=>"Сертификат об образовании","name_en"=>"Education certificate"),
            array("name_ka"=>"სხვა...","name_ru"=>"Другой...","name_en"=>"other..."),
        );
        DB::table('notices')->insert($notice);
    }
}
