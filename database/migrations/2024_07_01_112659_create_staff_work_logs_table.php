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
        Schema::create('staff_work_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('has_vacancy')->default(0);
            $table->integer('employed')->default(0);
            $table->integer('approved_by_employer')->default(0);
            $table->integer('has_probationary_period')->default(0);
            $table->integer('has_enrollment_vacancy')->default(0);
            $table->integer('candidate_has_registered')->default(0);
            $table->integer('has_enrollment_register')->default(0);
            $table->integer('add_vacancy')->default(0);
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
        Schema::dropIfExists('staff_work_logs');
    }
};
