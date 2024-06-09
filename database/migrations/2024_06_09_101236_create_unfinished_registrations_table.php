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
        Schema::create('unfinished_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('was_assigned_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(2);
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('was_assigned_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unfinished_registrations');
    }
};
