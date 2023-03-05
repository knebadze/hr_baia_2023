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
        Schema::create('work_information_work_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_information_id');
            $table->foreignId('work_schedule_id')->constrained();
            $table->timestamps();
            $table->foreign('work_information_id')
              ->references('id')->on('work_information')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_information_work_schedules');
    }
};
