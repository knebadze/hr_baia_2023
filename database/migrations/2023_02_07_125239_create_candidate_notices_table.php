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
        Schema::create('candidate_notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('notice_id')->constrained();
            $table->string('file');
            $table->string('file_path', 300);
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
        Schema::dropIfExists('candidate_notices');
    }
};
