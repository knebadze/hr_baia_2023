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
        Schema::create('vacancy_driving_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('driving_license_id')->constrained();
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
        Schema::dropIfExists('vacancy_driving_licenses');
    }
};
