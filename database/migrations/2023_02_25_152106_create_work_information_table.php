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
        Schema::create('work_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            $table->integer('payment');
            $table->foreignId('currency_id')->constrained();
            $table->string('additional_schedule_ka', 350)->nullable();
            $table->string('additional_schedule_en', 350)->nullable();
            $table->string('additional_schedule_ru', 350)->nullable();
            $table->boolean('go_vacation')->default(0);
            $table->boolean('stay_night')->default(0);
            $table->boolean('work_additional_hours')->default(0);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_information');
    }
};
