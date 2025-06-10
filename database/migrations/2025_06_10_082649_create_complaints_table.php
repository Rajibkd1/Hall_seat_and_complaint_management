<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/{timestamp}_create_complaints_table.php
public function up()
{
    Schema::create('complaints', function (Blueprint $table) {
        $table->id('complaint_id');
        $table->foreignId('student_id')->constrained('students');
        $table->enum('category', ['electrical', 'water', 'roommate', 'medical', 'harassment', 'safety', 'other']);
        $table->text('description');
        $table->boolean('emergency_flag');
        $table->enum('status', ['pending', 'in_progress', 'resolved']);
        $table->timestamp('submission_date');
        $table->string('image_url')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
