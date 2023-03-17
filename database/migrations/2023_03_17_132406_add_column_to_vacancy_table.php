<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->boolean('go_vacation')->default(0);
            $table->boolean('stay_night')->default(0);
            $table->boolean('work_additional_hours')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->dropColumn('go_vacation');
            $table->dropColumn('stay_night');
            $table->dropColumn('work_additional_hours');
        });
    }
};
