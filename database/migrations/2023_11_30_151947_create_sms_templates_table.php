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
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->text('template_ka');
            $table->text('template_ka_lt')->nullable();
            $table->text('template_en')->nullable();
            $table->text('template_ru')->nullable();
            $table->string('active', 5);
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
        Schema::dropIfExists('sms_templates');
    }
};
