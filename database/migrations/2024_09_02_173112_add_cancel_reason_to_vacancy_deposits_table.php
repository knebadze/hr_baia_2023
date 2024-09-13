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
        Schema::table('vacancy_deposits', function (Blueprint $table) {
            $table->unsignedBigInteger('candidate_cancel_reason_id')->nullable();
            $table->string('candidate_cancel_other_reason', 255)->nullable();

            // Add foreign key constraint
            $table->foreign('candidate_cancel_reason_id')
                  ->references('id')
                  ->on('enrollment_cancel_reasons')
                  ->onDelete('set null'); // Adjust onDelete action as needed

            $table->unsignedBigInteger('employer_cancel_reason_id')->nullable();
            $table->string('employer_cancel_other_reason', 255)->nullable();

            // Add foreign key constraint
            $table->foreign('employer_cancel_reason_id')
                ->references('id')
                ->on('enrollment_cancel_reasons')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancy_deposits', function (Blueprint $table) {
            $table->dropForeign(['candidate_cancel_reason_id']);
            $table->dropColumn(['candidate_cancel_reason_id', 'candidate_cancel_other_reason']);
            $table->dropForeign(['employer_cancel_reason_id']);
            $table->dropColumn(['employer_cancel_reason_id', 'employer_cancel_other_reason']);
        });
    }
};
