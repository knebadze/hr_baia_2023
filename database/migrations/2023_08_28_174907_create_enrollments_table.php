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
            $table->integer('enrollment_type');
            $table->unsignedBigInteger('author_id');
            $table->foreignId('vacancy_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('candidate_id')->nullable()->constrained()->onUpdate('cascade');
            $table->integer('who_is_counting')->nullable();
            $table->integer('type')->nullable();
            $table->string('name', 50);
            $table->integer('money');
            $table->float('hr_percent')->nullable();
            $table->float('hr_bonus');
            $table->string('file_path', 300)->nullable();
            $table->integer('agree')->default(0);
            $table->foreignId('status_id')->default(17)->constrained()->onUpdate('cascade');
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
