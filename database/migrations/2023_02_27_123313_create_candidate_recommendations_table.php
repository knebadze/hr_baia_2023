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
        Schema::create('candidate_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('recommendation')->nullable();
            $table->foreignId('recommendation_from_whom_id')->nullable()->constrained();
            $table->string('name_ka', 45)->nullable();
            $table->string('name_en', 45)->nullable();
            $table->string('name_ru', 45)->nullable();
            $table->string('position_ka')->nullable();
            $table->string('position_en')->nullable();
            $table->string('position_ru')->nullable();
            $table->foreignId('number_code_id')->nullable()->constrained();
            $table->string('number', 20)->nullable();
            $table->string('file')->nullable();
            $table->foreignId('no_reason_id')->nullable()->constrained();
            $table->string('no_reason_info_ka', 400)->nullable();
            $table->string('no_reason_info_en', 400)->nullable();
            $table->string('no_reason_info_ru', 400)->nullable();
            $table->string('uuid')->nullable();
            $table->timestamps();
            $table->foreign('recommendation')->references('id')->on('yes_nos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_recommendations');
    }
};
