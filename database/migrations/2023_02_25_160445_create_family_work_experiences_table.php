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
        Schema::create('family_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->smallInteger('experience');
            $table->integer('families_worked_count')->nullable();
            $table->unsignedBigInteger('longest_time')->nullable();
            $table->foreignId('work_experience_id')->nullable()->constrained();
            $table->foreignId('no_reason_id')->nullable()->constrained();
            $table->string('no_reason_info_ka')->nullable();
            $table->string('no_reason_info_en')->nullable();
            $table->string('no_reason_info_ru')->nullable();
            $table->timestamps();


            $table->foreign('longest_time')->references('id')->on('work_experiences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_work_experiences');
    }
};
