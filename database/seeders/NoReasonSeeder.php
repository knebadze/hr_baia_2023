<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('no_reasons')->delete();
        $data = array(
            array("name_ka"=>"დაოჯახება","name_ru"=>"Замужество","name_en"=>"getting married","category"=>"1"),
            array("name_ka"=>"მრავალშვილიანობა","name_ru"=>"Многодетье","name_en"=>"polygamy","category"=>"1"),
            array("name_ka"=>"მეუღლე მუშაობდა/მუშაობს მუდამ","name_ru"=>"Супруг(а), работал/работает все время","name_en"=>"Spouse worked/works all the time","category"=>"1"),
            array("name_ka"=>"მძიმე დაავადების გადატანა","name_ru"=>"Перенес Тяжелого Заболевания","name_en"=>"Transmission of severe disease","category"=>"1"),
            array("name_ka"=>"სამხედრო სავალდებულო სამსახური","name_ru"=>"Военная обязательная служба","name_en"=>"Military mandatory service","category"=>"1"),
            array("name_ka"=>"სწავლა/განათლება","name_ru"=>"учеба/образование","name_en"=>"study/education","category"=>"1"),
            array("name_ka"=>"საზღვარგარეთ ყოფნა","name_ru"=>"Жил за границей","name_en"=>"Being abroad","category"=>"1"),
            array("name_ka"=>"პირადი შეხედულებები","name_ru"=>"Личные взгляды","name_en"=>"personal views","category"=>"1"),
            array("name_ka"=>"ვმუშაობდი საზღვარგარეთ","name_ru"=>"Работал(а), за границей","name_en"=>"I worked abroad","category"=>"2"),
            array("name_ka"=>"წინა რეკომენდატორი გადავიდა საზღვარგარეთ","name_ru"=>"Предыдущий рекомендатель переехал за границу","name_en"=>"The previous recommender moved abroad","category"=>"2"),
            array("name_ka"=>"წინა რეკომენდატორმა შეიცვალა საცხოვრებელი ადგილი","name_ru"=>"Предыдущий рекомендатель сменил место жительства","name_en"=>"The previous recommender changed his place of residence","category"=>"2"),
            array("name_ka"=>"სხვა...","name_ru"=>"Другой...","name_en"=>"other...","category"=>"3"),
            array("name_ka"=>"კანდიდატს აღარ სურს მუშაობა","name_ru"=>"","name_en"=>"","category"=>"4"),
            array("name_ka"=>"შემკვეთს სურს კანდიდატის შეცვლა","name_ru"=>"","name_en"=>"","category"=>"4"),
            array("name_ka"=>"შემკვეთს სურს ვაკანსიის შეწყვეტა","name_ru"=>"","name_en"=>"","category"=>"4"),
            array("name_ka"=>"ვაკანსიის ვადა ამოიწურა","name_ru"=>"","name_en"=>"","category"=>"4"),
        );
        DB::table('no_reasons')->insert($data);
    }
}
