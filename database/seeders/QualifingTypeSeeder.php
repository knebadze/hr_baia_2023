<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QualifingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualifying_types')->delete();
        $data = array(
            array("name"=>"მოიაზრება"),
            array("name"=>"დაინტერესდა"),
            array("name"=>"გასაუბრებაზე ცხადდება"),
            array("name"=>"დამსაქმებლის მოჭონებული"),
            array("name"=>"გამოსაცდელი ვადით"),
            array("name"=>"დასაქმდა მუდმივად"),
            array("name"=>"დასაქმდა პერიოდულად"),
        );
        DB::table('qualifying_types')->insert($data);
    }
}
