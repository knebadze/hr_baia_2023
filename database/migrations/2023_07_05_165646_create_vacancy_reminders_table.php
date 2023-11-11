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
        // ამის გადაკეთება შეიძლება ჩანაწერი და დავალების სტანდარტზე.
        Schema::create('vacancy_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hr_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('date');
            $table->string('reason', 500);
            $table->smallInteger('main')->default(0);
            $table->smallInteger('main_stage_id')->default(0);
            $table->smallInteger('active')->default(0);
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
        Schema::dropIfExists('vacancy_reminders');
    }
};
