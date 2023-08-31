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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hr_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('fixed_salary');
            $table->float('hr_bonus_from_vacancy')->default(0);
            $table->integer('hr_bonus_from_paid_registration')->default(0);
            $table->integer('hr_bonus_from_free_registration')->default(0);
            $table->float('full_salary')->nullable();
            $table->dateTime('disbursement_date')->nullable();
            $table->integer('hr_agree')->default(0);
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
        Schema::dropIfExists('salaries');
    }
};
