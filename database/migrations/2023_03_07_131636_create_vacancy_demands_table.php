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
        Schema::create('vacancy_demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->foreignId('education_id')->nullable()->constrained();
            $table->foreignId('specialty_id')->nullable()->constrained();
            $table->string('additional_duty_ka', 400)->nullable();
            $table->string('additional_duty_en', 400)->nullable();
            $table->string('additional_duty_ru', 400)->nullable();
            $table->foreignId('language_id')->nullable()->constrained();
            $table->foreignId('language_level_id')->nullable()->constrained();
            $table->smallInteger('has_experience')->default(0);
            $table->smallInteger('has_recommendation')->default(0);
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
        Schema::dropIfExists('vacancy_demands');
    }
};
