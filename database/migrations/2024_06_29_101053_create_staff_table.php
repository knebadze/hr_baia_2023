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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name_ka')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('number')->unique();
            $table->date('date_of_birth')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained();
            $table->string('avatar', 255)->nullable();
            $table->string('password');
            $table->char('person_number', 11);
            $table->char('mobile', 10)->nullable();
            $table->char('inside_number', 10)->nullable();
            $table->float('bonus_percent')->nullable();
            $table->integer('fixed_salary')->nullable();
            $table->foreignId('branch_id')->constrained();
            $table->tinyInteger('internship')->default(0);
            $table->string('fb_link')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->smallInteger('status')->default(0);
            $table->integer('verify_code')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')
            ->references('id')->on('staff')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
