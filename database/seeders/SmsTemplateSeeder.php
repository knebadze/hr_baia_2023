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
            array("name"=>"add_vacancy_send_employer", "description" => "ვაკანსიის დამატების დროს - დამსაქმებელს", "template_ka"=>"თქვენ მოგემსახურებათ HR {name} T: {number}, რომელიც დაგიკავშირდებათ 3 წუთის შიგნით", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"add_vacancy_send_hr", "description" => "ვაკანსიის დამატების დროს - HR_ს", "template_ka"=>"შესასრულებლად დაგეწერათ ვაკანსია {code}, კატეგორია {category} ტ: {number} გთხოვთ დაუკავშირდეთ 3 წუთის შიგნით და შემდეგ შეცვალოთ ვაკანსიის სტატუსი", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"employer_want_call_you_hr", "description" => "დამსაქმებელი ცდილობს HR_თან დაკავშირებას - HR_ს", "template_ka"=>"თქვენთან დაკავშირებას ცდილობს შემკვეთი {name}; {number}, გთხოვთ ეხლავე დაუკავშირდეთ", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"vacancy_production_status_employer", "description" => "ვაკანსიის წარმოებაში გადაყვანისას - დამსაქმებელს", "template_ka"=>"მოგესალმებით თქვენი ვაკანსია იმყოფება წარმოებაში კადრის აყვანის შემთხვევაში ერთჯერადად იხდით: მომსახურების საფასურად წარმოდგენილი ანაზღაურების მხოლოდ 10%-ს + კანდიდატის პირველი თვის ანაზღაურებიდან 50% (დარჩენილ 50%-ს თვის ბოლოს უნაზღაურებთ მას), ჯამში უნდა ჩაირიცხოს {employer_enroll} '+' {candidate_enroll} ლარი", "template_ka_lt"=>"", "template_en"=>null, "template_ru"=>null, "active" => "ka"),

            array("name"=>"interested_candidate_hr", "description" => "ვაკანსიით დაინტერესება - HR_ს", "template_ka"=>"ვაკანსია N {code} დაინტერესდა სახელი: {name} ID: {id}", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"interested_candidate_employer", "description" => "ვაკანსიით დაინტერესება - დამსაქმებელს", "template_ka"=>"გეგზავნებათ თქვენს მოთხოვნებთან მაქსიმალურ შესაბამისობაში მოყვანილი კანდიდატის ფოტოანკეტა, დაინტერესების შემთხვევაში გთხოვთ ეწვიეთ ლინკს: {link}", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"probation_period_candidate", "description" => "გამოსაცდელი ვადის მიმოხილვა - კანდიდატს", "template_ka"=>"მოგესალმებით {name}, გთხოვთ გვაცნობოთ, როგორ ჩაიარა გამოსაცდელი ვადის სამუშაო, დღემ? რა მოგწონთ ან არ მოგწონთ? პატივისცემით: 'ბაია' -ს HR {number} - {name}", "template_ka_lt"=>"Mogesalmebit {name}, gtxovt gvacnobot rogor chaiara gamosacdeli vadis samushao dgem? ra mogcont an ar mogcont? pativiscemit: 'BAIA'-s HR {number} - {name} ", "template_en"=>"", "template_ru"=>"", "active" => "ka_lt"),

            array("name"=>"probation_period_employer", "description" => "გამოსაცდელი ვადის მიმოხილვა - დამსაქმებელს", "template_ka"=>"დილამშვიდობის {name}, გთხოვთ გვაცნობოთ, როგორ ჩაიარა ჩვენი კანდიდატის სამუშაო დღემ თქვენთან? რა მოგწონთ / არ მოგწონთ მასში? პატივისცემით: 'ბაია' -ს HR {number} - {name}", "template_ka_lt"=>"dila mshvidobisa {name}, gtxovt gvacnobot rogor chaiara chveni kandidatis samushao dgem tqventan? ra mogcont / ar mogcont masshi? pativiscemit: 'BAIA'-s HR {number} - {name} ", "template_en"=>"", "template_ru"=>"", "active" => "ka_lt"),

            array("name"=>"interview_period_time_change_employer", "description" => "გასაუბრების დროის შეცვლის შესახებ - დამსაქმებელს", "template_ka"=>"{name}, შეგახსენებთ, რომ გასაუბრებაზე თქვენს მიერ მოწონებულ კადრზე თქვენის მხრიდან აზრის შეცვლა გვაცნობოთ შეთანხმებულ დროში. პატივისცემით: HR {number} - {name}", "template_ka_lt"=>"{name},  shegaxsenebt, rom gasaubrebaze tqvens mier moconebul kadrze tqvenis mxridan azris shecvla gvacnobet shetanxmebul droshi, pativiscemit: {number} - {name}", "template_en"=>"", "template_ru"=>"", "active" => "ka_lt"),

            array("name"=>"deposit_enrolled_candidate_or_employer", "description" => "შეხსენება ჩარიცხვის თარიღის - კანდიდატს ან დამსაქმებელს", "template_ka"=>"{name}, მოგესალმებით და შეგახსენებთ, რომ თქვენი მიმდინარე დავალიანების {money} ლარი დაფარვის ბოლო ვადაა {date}. გადაცილების შემთხვევაში თითოეულ ვადაგადაცილებულ დღეზე დაგეკისრებათ პირგასამტეხლო დღეში 2 ლარის ოდენობით. მადლობას გიხდით თანამშრომლობისათვის. ©#ბაია", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"deposit_enrolled_employer", "description" => "ვადაგადაცილების შესახებ - დამსაქმებელს", "template_ka"=>"{name}, მოგესალმებით და შეგახსენებთ, რომ თქვენი მიმდინარე დავალიანების {money} ლარი დაფარვის ბოლო ვადაა {date}. გადაცილების შემთხვევაში თითოეულ ვადაგადაცილებულ დღეზე დაგეკისრებათ პირგასამტეხლო დღეში 2 ლარის ოდენობით. მადლობას გიხდით თანამშრომლობისათვის. ©#ბაია", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"confirmed_enrollment_admin", "description" => "დასადასტურებელი ჩარიცხვა - ადმინს", "template_ka"=>"დასადასტურებელი ჩარიცხვა: HR {hrInicial}, {money} ლარი, {code}. link: {url}", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"confirmed_enrollment_admin", "description" => "დადასტურებული ჩარიცხვა - HR_ს", "template_ka"=>"დადასტურებული ჩარიცხვა: HR {hrInicial}, { money } ლარი, {code}. link: {url}", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),


            array("name"=>"recommendation", "description" => "კანდიდატის რეკომენდაციის ბმული - რეკომენდატორს", "template_ka"=>"გთხოვთ ბმულზე გადასვლით დაახასიათოთ თქვენი ყოფილი პერსონალი:{name}. LINK: https://forms.gle/3SR79M7mTDtE4otH7", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"hr_sesion_block", "description" => "დღის დაბლოკვა - HR_ს", "template_ka"=>"თქვენ არ გაქვთ წინა დღის სესია დახურული, კერძოდ: {text} კანდიდატი არ გყავთ არცერთ ვაკანსიაზე, რის გამოც შეგეზღუდათ მონაცემა ბაზასთან წვდომა. გთხოვთ მიმართოთ ხელმძღვანელობას", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),

            array("name"=>"hr_sesion_block_info_admin", "description" => "დღის დაბლოკვა - ადმინს", "template_ka"=>"დღეს დაიბლოკნენ შემდეგი HR-ები: {name}", "template_ka_lt"=>"", "template_en"=>"", "template_ru"=>"", "active" => "ka"),


        );
        DB::table('sms_templates')->insert($data);
    }
}
