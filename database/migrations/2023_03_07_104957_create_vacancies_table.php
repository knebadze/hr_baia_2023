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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreignId('hr_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('title_ka')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('slug');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->default(1)->constrained();
            $table->string('address_ka')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ru')->nullable();
            $table->integer('payment');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('work_schedule_id')->constrained();
            $table->string('additional_schedule_ka', 300)->nullable();
            $table->string('additional_schedule_en', 300)->nullable();
            $table->string('additional_schedule_ru', 300)->nullable();
            $table->string('for_who_ka')->nullable();
            $table->string('for_who_en')->nullable();
            $table->string('for_who_ru')->nullable();
            $table->string('comment')->nullable();
            $table->string('additional_ka', 500)->nullable();
            $table->string('additional_en', 500)->nullable();
            $table->string('additional_ru', 500)->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->foreign('author_id')
            ->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
};
