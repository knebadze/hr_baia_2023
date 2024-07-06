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
        Schema::create('rewrite_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('old_hr_id');
            $table->unsignedBigInteger('new_hr_id');
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('old_hr_id')->references('id')->on('staff');
            $table->foreign('new_hr_id')->references('id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewrite_histories');
    }
};
