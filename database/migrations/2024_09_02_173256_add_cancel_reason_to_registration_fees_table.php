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
        Schema::table('registration_fees', function (Blueprint $table) {
            Schema::table('registration_fees', function (Blueprint $table) {
                $table->unsignedBigInteger('cancel_reason_id')->nullable();
                $table->string('cancel_other_reason', 255)->nullable();

                // Add foreign key constraint
                $table->foreign('cancel_reason_id')
                      ->references('id')
                      ->on('enrollment_cancel_reasons')
                      ->onDelete('set null'); // Adjust onDelete action as needed
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_fees', function (Blueprint $table) {
            $table->dropForeign(['cancel_reason_id']);
            $table->dropColumn(['cancel_reason_id', 'cancel_other_reason']);
        });
    }
};
