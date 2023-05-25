<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('benefits')->delete();
        $data = array(
            array("name_ka"=>"უფასო სატრანსპორტო ბარათი","name_en"=>"Free transport card","name_ru"=>"Бесплатная транспортная карта"),
            array("name_ka"=>"სამედიცინო დაზღვევა","name_en"=>"Medical insurance","name_ru"=>"Медицинская страховка"),
            array("name_ka"=>"ყველა სახელმწიფო დასვენების დღეებში დასვენება","name_en"=>"Rest on all public holidays","name_ru"=>"Отдых во все праздничные дни"),
            array("name_ka"=>"აგარაკზე გაყოლის შემთხვევაში ხელფასზე დანამატი","name_en"=>"Supplement to the salary in case of staying at the country house","name_ru"=>"Доплата к зарплате в случае вьезда на даче"),
            array("name_ka"=>"კანდიდატს შეუძლია რამოდენიმე საათით გავიდეს პირად საქმეებზე","name_en"=>"The candidate can leave for a few hours on personal matters","name_ru"=>"Кандидат может вийти на несколько часов по личным делам"),
            array("name_ka"=>"გამოცდილება არ მოითხოვება","name_en"=>"No experience required","name_ru"=>"Опыт не требуется"),
            array("name_ka"=>"საწვავი","name_en"=>"fuel","name_ru"=>"топливо"),
            array("name_ka"=>"ვაუჩერები დასასვენებელ ზონაში","name_en"=>"Vouchers in the recreation area","name_ru"=>"Путевки в зону отдыха"),
            array("name_ka"=>"ულიმიტო სატელეფონო ბარათი","name_en"=>"Unlimited phone card","name_ru"=>"Безлимитная телефонная карта"),
            array("name_ka"=>"ფიტნეს დარბაზის აბონიმენტი","name_en"=>"Fitness hall subscription","name_ru"=>"Абонемент в фитнес-зал"),
            array("name_ka"=>"კანდიდატს მოემსახურება მძღოლი","name_en"=>"A driver will serve the candidate","name_ru"=>"Кандидата будет обслуживать Водитель"),
        );
        DB::table('benefits')->insert($data);
    }
}
