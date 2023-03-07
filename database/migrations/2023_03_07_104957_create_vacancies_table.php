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
            $table->string('title');
            $table->string('slug');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->default(1)->constrained();
            $table->string('address')->nullable();
            $table->integer('payment');
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('work_schedule_id')->constrained();
            $table->string('additional_schedule');
            $table->string('for_who');
            $table->string('comment');
            $table->string('additional', 500);
            $table->string('photo');
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
