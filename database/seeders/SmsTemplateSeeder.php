<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms_templates')->delete();
        $data = array(
            array("name"=>"add_vacancy_send_employer", "template_ka"=>"თქვენ მოგემსახურებათ HR {name} T: {number}, რომელიც დაგიკავშირდებათ 3 წუთის შიგნით", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"add_vacancy_send_hr", "template_ka"=>"შესასრულებლად დაგეწერათ ვაკანსია {code}, კატეგორია {category} ტ: {number} გთხოვთ დაუკავშირდეთ 3 წუთის შიგნით და შემდეგ შეცვალოთ ვაკანსიის სტატუსი", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"try_add_vacancy_again_send_employer", "template_ka"=>"თქვენ უკვე გემსახურებათ  HR {name} T: {number}, რომელიც დაგიკავშირდებათ უახლოეს წუთებში...", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"try_add_vacancy_again_send_hr", "template_ka"=>"თქვენთან დაკავშირებას სცდილობს შემკვეთი {name} {number}, გთხოვთ ეხლავე დაუკავშირდეთ", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"probation_period_candidate", "template_ka"=>"მოგესალმებით { name }, გთხოვთ გვაცნობოთ, როგორ ჩაიარა გამოსაცდელი ვადის სამუშაო, დღემ? რა მოგწონთ ან არ მოგწონთ? პატივისცემით: 'ბაია' -ს HR { number } - { name }", "template_ka_lt"=>"Mogesalmebit { name }, gtxovt gvacnobot rogor chaiara gamosacdeli vadis samushao dgem? ra mogcont an ar mogcont? pativiscemit: 'BAIA'-s HR { number } - { name } ", "template_en"=>"", "template_ru"=>""),

            array("name"=>"probation_period_employer", "template_ka"=>"დილამშვიდობის { name }, გთხოვთ გვაცნობოთ, როგორ ჩაიარა ჩვენი კანდიდატის სამუშაო დღემ თქვენთან? რა მოგწონთ / არ მოგწონთ მასში? პატივისცემით: 'ბაია' -ს HR { number } - { name }", "template_ka_lt"=>"dila mshvidobisa { name }, gtxovt gvacnobot rogor chaiara chveni kandidatis samushao dgem tqventan? ra mogcont / ar mogcont masshi? pativiscemit: 'BAIA'-s HR { number } - { name } ", "template_en"=>"", "template_ru"=>""),

            array("name"=>"interview_period_employer", "template_ka"=>"{ name }, შეგახსენებთ, რომ გასაუბრებაზე თქვენს მიერ მოწონებულ კადრზე თქვენის მხრიდან აზრის შეცვლა გვაცნობოთ შეთანხმებულ დროში. პატივისცემით: HR { number } - { name }", "template_ka_lt"=>"{ name },  shegaxsenebt, rom gasaubrebaze tqvens mier moconebul kadrze tqvenis mxridan azris shecvla gvacnobet shetanxmebul droshi, pativiscemit: { number } - { name } ", "template_en"=>"", "template_ru"=>""),

            array("name"=>"deposit_enrolled_candidate_or_employer", "template_ka"=>"ქალბატონო { name }, მოგესალმებით და შეგახსენებთ, რომ თქვენი მიმდინარე დავალიანების { money } ლარი დაფარვის ბოლო ვადაა { date }. გადაცილების შემთხვევაში თითოეულ ვადაგადაცილებულ დღეზე დაგეკისრებათ პირგასამტეხლო დღეში 2 ლარის ოდენობით. მადლობას გიხდით თანამშრომლობისათვის. ©#ბაია", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"deposit_enrolled_employer", "template_ka"=>"ქალბატონო { name }, მოგესალმებით და შეგახსენებთ, რომ თქვენი მიმდინარე დავალიანების { money } ლარი დაფარვის ბოლო ვადაა { date }. გადაცილების შემთხვევაში თითოეულ ვადაგადაცილებულ დღეზე დაგეკისრებათ პირგასამტეხლო დღეში 2 ლარის ოდენობით. მადლობას გიხდით თანამშრომლობისათვის. ©#ბაია", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"confirmed_enrollment_admin", "template_ka"=>"დასადასტურებელი ჩარიცხვა: HR { hrInicial }, { money } ლარი, { code }. link: { url }", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"confirmed_enrollment_admin", "template_ka"=>"დადასტურებული ჩარიცხვა: HR { hrInicial }, { money } ლარი, { code }. link: { url }", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"interestied_candidate", "template_ka"=>"თქვენი დაინტერესება მიღებულია, შემკვეთს გადაეგზავნება თქვენი ფოტოანკეტა, მოხდება მასთან თქვენი კანდიდატურის განხილვა და მისი მხრიდანაც დაინტერესების შემთხვევაში გაგასაუბრებთ შემკვეთს", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"interestied_candidate_hr", "template_ka"=>"ვაკანსია N { code } დაინტერესდა სახელი: {fullName} ID: { id }", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"interestied_employer_hr", "template_ka"=>"ვაკანსია N {code}-ის შემკვეთი დაინტერესდა სახელი: {fullName} ID: { id } ფოტოანკეტით", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"recommendation", "template_ka"=>"გთხოვთ ბმულზე გადასვლით დაახასიათოთ თქვენი ყოფილი პერსონალი:{ fullName }. LINK: https://forms.gle/3SR79M7mTDtE4otH7", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"hr_sesion_block", "template_ka"=>"თქვენ არ გაქვთ წინა დღის სესია დახურული, კერძოდ: { text } კანდიდატი არ გყავთ არცერთ ვაკანსიაზე, რის გამოც შეგეზღუდათ მონაცემა ბაზასთან წვდომა. გთხოვთ მიმართოთ ხელმძღვანელობას", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),

            array("name"=>"hr_sesion_block_info_admin", "template_ka"=>"დღეს დაიბლოკნენ შემდეგი HR-ები: {hrsFullName}", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>""),
        );
        DB::table('sms_templates')->insert($data);
    }
}
