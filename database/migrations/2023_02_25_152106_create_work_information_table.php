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
            $table->foreignId('work_schedule_id')->constrained();
            $table->time('from_hour', 0);
            $table->time('to_hour', 0);
            $table->integer('payment');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('general_characteristic_id')->constrained();
            $table->integer('families_worked_count', 2);
            $table->unsignedBigInteger('longest_time');
            $table->timestamps();

            $table->foreign('longest_time')->references('id')->on('work_experiences');
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
