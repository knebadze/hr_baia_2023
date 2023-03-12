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
            $table->foreignId('work_experience_id')->nullable()->constrained();
            $table->string('position_ka')->nullable();
            $table->string('position_en')->nullable();
            $table->string('position_ru')->nullable();
            $table->string('object_ka')->nullable();
            $table->string('object_en')->nullable();
            $table->string('object_ru')->nullable();
            $table->foreignId('no_reason_id')->nullable()->constrained();
            $table->string('no_reason_info_ka')->nullable();
            $table->string('no_reason_info_en')->nullable();
            $table->string('no_reason_info_ru')->nullable();
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
