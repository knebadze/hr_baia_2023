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
        Schema::create('family_work_duties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_work_experience_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('candidate_duty_id')->constrained();
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
        Schema::dropIfExists('family_work_duties');
    }
};
