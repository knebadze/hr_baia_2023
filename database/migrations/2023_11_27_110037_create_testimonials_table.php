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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('fullName_ka', 150);
            $table->string('fullName_en', 150);
            $table->string('fullName_ru', 150);
            $table->string('profession_ka', 150);
            $table->string('profession_en', 150);
            $table->string('profession_ru', 150);
            $table->string('text_ka', 500);
            $table->string('text_en', 500);
            $table->string('text_ru', 500);
            $table->string('image_path', 500)->nullable();
            $table->smallInteger('is_active')->default(0);
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
        Schema::dropIfExists('testimonials');
    }
};
