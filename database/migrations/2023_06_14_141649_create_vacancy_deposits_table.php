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
        Schema::create('vacancy_deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('candidate_initial_amount')->default(0);
            $table->integer('employer_initial_amount')->default(0);
            $table->integer('must_be_enrolled_employer')->default(0);
            $table->date('must_be_enrolled_employer_date')->nullable();
            $table->integer('must_be_enrolled_candidate')->default(0);
            $table->date('must_be_enrolled_candidate_date')->nullable();
            // $table->integer('enrolled_employer')->default(0);
            // $table->dateTime('enrolled_employer_date')->nullable();
            // $table->integer('enrolled_candidate')->default(0);
            // $table->dateTime('enrolled_candidate_date')->nullable();
            // $table->integer('employer_percent')->default(0);
            // $table->integer('hr_percent')->default(0);
            // $table->integer('hr_bonus')->nullable();
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
        Schema::dropIfExists('vacancy_deposits');
    }
};
