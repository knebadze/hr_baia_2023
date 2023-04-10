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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);INSERT INTO hrs (
                id,
                user_id,
                person_number,
                mobile,
                inside_number,
                fb_link,
                created_at,
                updated_at
              )
            VALUES (
                'id:bigint',
                'user_id:bigint',
                'person_number:char',
                'mobile:char',
                'inside_number:char',
                'fb_link:varchar',
                'created_at:timestamp',
                'updated_at:timestamp'
              );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
