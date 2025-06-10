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
        $table->foreignId('complaint_id')->constrained('complaints');
        $table->foreignId('student_id')->constrained('students');
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
