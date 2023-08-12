<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_types')->delete();
        $data = array(
            array("type"=>"vacancy"),
            array("type"=>"candidate"),
        );
        DB::table('status_types')->insert($data);
    }
}
