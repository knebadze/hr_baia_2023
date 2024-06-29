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
            $table->unsignedBigInteger('parent_id');
            $table->string('name_ka')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('email')->unique();
            $table->string('number')->nullable()->unique();
            $table->date('date_of_birth')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained();
            $table->string('avatar', 255)->nullable();
            $table->string('password');
            $table->char('person_number', 20);
            $table->char('mobile', 10);
            $table->char('inside_number', 20);
            $table->float('bonus_percent');
            $table->integer('fixed_salary');
            $table->integer('branch_id');
            $table->tinyInteger('internship')->default(0);
            $table->string('fb_link')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->smallInteger('status')->default(0);
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
