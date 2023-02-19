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
            $table->tinyInteger('recommendation')->default(0);
            $table->foreignId('recommendation_from_whom_id')->default(1)->constrained();
            $table->string('name', 45)->nullable();
            $table->string('position')->nullable();
            $table->string('number', 20)->nullable();
            $table->string('file')->nullable();
            $table->string('no_reason_info', 400);
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
