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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('type');
            $table->string('name', 50);
            $table->integer('money');
            $table->float('hr_percent');
            $table->float('hr_bonus');
            $table->string('file_path', 300);
            $table->integer('agree')->nullable();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
};
