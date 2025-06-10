<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_seat_applications_table.php
public function up()
{
    Schema::create('seat_applications', function (Blueprint $table) {
        $table->id('application_id');
        $table->foreignId('student_id')->constrained('students');
        $table->decimal('cgpa');
        $table->decimal('home_distance_km');
        $table->boolean('financial_need');
        $table->integer('guardian_yearly_income');
        $table->string('special_quota')->nullable();
        $table->enum('disciplinary_status', ['clear', 'probation', 'suspended']);
        $table->string('BNCC_status')->nullable();
        $table->text('documents_uploaded');
        $table->string('special_note')->nullable();
        $table->enum('type', ['new', 'renewal']);
        $table->enum('status', ['pending', 'approved', 'rejected', 'waitlisted']);
        $table->decimal('score');
        $table->timestamp('submission_date');
        $table->boolean('admin_override');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_applications');
    }
};
