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
            $table->tinyInteger('recommendation')->nullable();
            $table->foreignId('recommendation_from_whom_id')->nullable()->constrained();
            $table->string('name', 45)->nullable();
            $table->string('position')->nullable();
            $table->string('number', 20)->nullable();
            $table->string('file')->nullable();
            $table->foreignId('no_reason_id')->nullable()->constrained();
            $table->string('no_reason_info', 400)->nullable();
            $table->string('uuid');
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
        Schema::dropIfExists('candidate_recommendations');
    }
};
