<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->delete();
        $role = array(
            array("name"=>"Candidate"),
            // array("name"=>"Employer"),
            array("name"=>"Personal"),
            array("name"=>"Unknown"),
        );
        DB::table('user_types')->insert($role);
    }
}
