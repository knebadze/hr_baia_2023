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
        Schema::create('employer_additional_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('number_code_id')->nullable()->constrained();
            $table->string('number');
            $table->foreignId('number_owner_id')->constrained();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('employer_additional_numbers');
    }
};
