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
        Schema::create('vacancy_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->smallInteger('employer_answer')->nullable();
            $table->dateTime('interview_date')->nullable();
            $table->foreignId('interview_place_id')->constrained()->onUpdate('cascade')->nullable();
            $table->smallInteger('agree')->nullable();
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
        Schema::dropIfExists('vacancy_interests');
    }
};
