<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlackListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blacklist_grounds')->delete();
        $data = array(
            array("name_ka"=>"სხვა სააგენტოდან მომართვიანობა","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"წინა სამუშაო ადგილიდან უარყოფითი დახასიათება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"გადასახადისათვის თავის ჯიუტად არიდება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"შემჩნეულია ტყუილებში","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"დადასტურებული ქურდობის ფაქტი","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"დაუდასტურებელი ქურდობის ფაქტი","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"ოჯახში მუშაობის გამოცდილება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"მისი წინა სამუშაოზე მუშაობისას ნივთები იკარგებოდა (ოჯახიდან, ობიექტიდან...)","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"ბავშვს/მოხუცს ექცეოდა უხეშად","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"შემკვეთის ოჯახის წევრებთან შედიოდა ხოლმე კონფლიქტში","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"გააჩნდა ჰიგიენის პრობლემები","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"სისტემატიური დაგვიანებები/გაცდენები","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"საერთოდ არ ჰქონდა ბავშვთან მიდგომა","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"სააგენტოს მიმართ გააჩნია უსაფუძვლო მოთხოვნები/პრეტენზიები და უცენზურო სიტყვებით ილანძღება.","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"წინა სამუშაო ადგილიდან შემკვეთის გადმოცემით შემჩნეულია ამორალურ საქციელში","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"შემკვეთთან გასაუბრების შემდგომ სცდილობდა სააგნტოს გვერდის ავლით მასთან მუშაობის დაწყებას","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"ფეისბუქზე სააგენტოს ვაკანსიებზე სისტემატურად აკეთებს შეურაცხმყოფელ კომენტარებს","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"სააგენტოში სათანადო ცნობების წარმოდგენისათვის თავის არიდება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"მიუხედავად თანხმობისა მინიმუმ 3-ჯერ არ გამოცხადდა გასაუბრებაზე","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"აღმოაჩნდა ,,ც'' ჰეპატიტი ან სხვა ინფექცია","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"აღმოაჩნდა კორონა","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"საერთოდ არ ჰქონდა ავადმყოფთან მუშაობის გამოცდილება","name_ru"=>"","name_en"=>""),
            array("name_ka"=>"სხვა","name_ru"=>"","name_en"=>""),
        );
        DB::table('blacklist_grounds')->insert($data);
    }
}
