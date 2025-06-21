<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_complaint_feedback_table.php
public function up()
{
    Schema::create('complaint_feedback', function (Blueprint $table) {
        $table->id('feedback_id');
        $table->unsignedBigInteger('complaint_id');
        $table->foreign('complaint_id')->references('complaint_id')->on('complaints')->onDelete('cascade');

         $table->unsignedBigInteger('student_id');
        $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

        $table->integer('rating');
        $table->text('comments');
        $table->timestamp('timestamp');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_feedback');
    }
};
