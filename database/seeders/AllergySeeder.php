<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergies')->delete();
        $allergy = array(
            array("name_ka"=>"არცერთზე","name_ru"=>"ни на одном","name_en"=>"no one"),
            array("name_ka"=>"ძაღლის ბეწვზე","name_ru"=>"на собачьей шерсти","name_en"=>"on dog fur"),
            array("name_ka"=>"კატის ბეწვზე","name_ru"=>"на кошачьей шерсти","name_en"=>"on cat fur"),
            array("name_ka"=>"თუთიყუშზე","name_ru"=>"на попугае","name_en"=>"on the parrot"),
            array("name_ka"=>"მცენარეებზე/სეზონურად","name_ru"=>"на растениях/сезонно","name_en"=>"on plants/seasonally"),
        );
        DB::table('allergies')->insert($allergy);
    }
}
