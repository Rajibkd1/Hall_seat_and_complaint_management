<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seat_renewal_applications', function (Blueprint $table) {
            $table->id('renewal_id');
            $table->unsignedBigInteger('allotment_id');
            $table->foreign('allotment_id')->references('allotment_id')->on('seat_allotments')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

            $table->integer('current_semesters');
            $table->decimal('last_semester_cgpa', 3, 2);
            $table->string('result_file_path')->nullable();
            $table->text('additional_comments')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('submission_date');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->foreign('reviewed_by')->references('admin_id')->on('admins')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_renewal_applications');
    }
};
