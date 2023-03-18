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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('company_object_type_id')->constrained();
            $table->string('object_type_ka')->nullable();
            $table->string('object_type_en')->nullable();
            $table->string('object_type_ru')->nullable();
            $table->string('company_name_ka')->nullable();
            $table->string('company_name_en')->nullable();
            $table->string('company_name_ru')->nullable();
            $table->string('position')->nullable();
            $table->string('address_ka')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ru')->nullable();
            $table->string('street_ka')->nullable();
            $table->string('street_en')->nullable();
            $table->string('street_ru')->nullable();
            $table->string('latitude', 45)->nullable();
            $table->string('longitude', 45)->nullable();
            $table->string('map_link', 500)->nullable();
            $table->string('fb_link', 500)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
