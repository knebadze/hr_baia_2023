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
        Schema::create('general_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('experience');
            $table->foreignId('work_experience_id')->constrained();
            $table->string('position');
            $table->string('object');
            $table->foreignId('no_reason_id')->constrained();
            $table->string('no_reason_info');
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
        Schema::dropIfExists('general_work_experiences');
    }
};
