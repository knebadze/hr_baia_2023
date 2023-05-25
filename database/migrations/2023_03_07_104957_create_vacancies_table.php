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
            $table->integer('code')->unique();
            $table->unsignedBigInteger('author_id');
            $table->foreignId('hr_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('title_ka')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('slug');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->default(1)->constrained();
            $table->integer('payment');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('work_schedule_id')->constrained();
            $table->string('additional_schedule_ka', 300)->nullable();
            $table->string('additional_schedule_en', 300)->nullable();
            $table->string('additional_schedule_ru', 300)->nullable();
            $table->date('start_date');
            $table->foreignId('term_id')->constrained();
            $table->string('comment')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('go_vacation')->default(0);
            $table->boolean('stay_night')->default(0);
            $table->boolean('work_additional_hours')->default(0);
            $table->dateTime('interview_date');
            $table->foreignId('interview_place_id')->constrained();
            $table->timestamps();
            $table->foreign('author_id')
            ->references('id')->on('employers')->onUpdate('cascade')->onDelete('cascade');
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
