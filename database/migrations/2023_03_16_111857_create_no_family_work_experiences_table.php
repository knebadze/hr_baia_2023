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
        Schema::create('no_family_work_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_information_id')->nullable();
            $table->tinyInteger('experience');
            $table->foreignId('work_experience_id')->nullable()->constrained();
            $table->string('object_ka')->nullable();
            $table->string('object_en')->nullable();
            $table->string('object_ru')->nullable();
            $table->foreignId('no_reason_id')->nullable()->constrained();
            $table->string('no_reason_info_ka')->nullable();
            $table->string('no_reason_info_en')->nullable();
            $table->string('no_reason_info_ru')->nullable();
            $table->timestamps();
            $table->foreign('work_information_id', 'w_i_n_f_w_e')->references('id')->on('work_information')->onUpdate('cascade')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('no_family_work_experiences');
    }
};
