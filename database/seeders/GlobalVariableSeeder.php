<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GlobalVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('global_variables')->delete();
        $data = array(
            array("name"=>"paid_registration","description"=>"რეგისტრაციის გადასახადი","meaning"=>"30"),
        );
        DB::table('global_variables')->insert($data);
    }
}
