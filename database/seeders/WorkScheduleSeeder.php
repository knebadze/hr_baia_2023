<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_schedules')->delete();
        $schedule = array(
            array("name_ka"=>"დღის გრაფიკი","name_en"=>"schedule of the day","name_ru"=>"Дневной графык"),
            array("name_ka"=>"სადღეღამისო","name_en"=>"day and night","name_ru"=>"Круглосуточный"),
            array("name_ka"=>"დღის პირველი ნახევარი","name_en"=>"first half of the day","name_ru"=>"Первая половина дня"),
            array("name_ka"=>"დღის მეორე ნახევარი","name_en"=>"the second half of the day","name_ru"=>"Вторая половина дня"),
            array("name_ka"=>"მხოლოდ ღამე","name_en"=>"only night","name_ru"=>"Только ночью"),
            array("name_ka"=>"მხოლოდ შაბათ-კვირას","name_en"=>"Only on weekends","name_ru"=>"Только по выходным"),
            array("name_ka"=>"ცვლებში","name_en"=>"in shifts","name_ru"=>"Посменно"),
            array("name_ka"=>"ერთჯერადად","name_en"=>"one time","name_ru"=>"Одноразово"),
            array("name_ka"=>"კვირაში რამოდენიმე დღე","name_en"=>"one several days a week","name_ru"=>"несколько дней в неделю"),
            array("name_ka"=>"სხვა...","name_en"=>"Other …","name_ru"=>"Другой …"),
            array("name_ka"=>"ნებისმიერი","name_en"=>"any ","name_ru"=>"Любой"),
        );
        DB::table('work_schedules')->insert($schedule );
    }
}
