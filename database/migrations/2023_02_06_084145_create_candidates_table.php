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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('personal_number', 25)->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->tinyInteger('convection')->default(0);
            $table->tinyInteger('smoke')->default(0);
            $table->foreignId('nationality_id')->nullable()->constrained();
            $table->foreignId('religion_id')->nullable()->constrained();
            $table->foreignId('education_id')->nullable()->constrained();
            $table->foreignId('marital_status_id')->nullable()->constrained();
            $table->tinyInteger('work_abroad')->default(0);
            $table->tinyInteger('children')->nullable();
            $table->string('children_age', 45)->nullable();
            $table->string('spouse', 500)->nullable();
            $table->string('medical_info', 500)->nullable();
            $table->string('driving_license', 45)->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('latitude', 45)->nullable();
            $table->string('longitude', 45)->nullable();
            $table->string('fb_link', 500)->nullable();
            $table->string('youtube_link', 500)->nullable();
            $table->string('map_link', 500)->nullable();
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
        Schema::dropIfExists('candidates');
    }
};
