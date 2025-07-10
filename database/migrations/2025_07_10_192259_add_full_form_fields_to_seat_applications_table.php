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
        Schema::table('seat_applications', function (Blueprint $table) {
            //
            // Personal Info
            $table->string('student_name')->nullable();
            $table->string('department')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_mobile')->nullable();
            $table->string('guardian_relationship')->nullable();

            // Academic Info
            $table->string('program')->nullable(); // bachelor, masters, etc.
            $table->integer('semester_year')->nullable();
            $table->integer('semester_term')->nullable();

            // Already exists: cgpa

            // Physical and Family Status
            $table->string('physical_condition')->nullable();
            $table->string('family_status')->nullable();

            // Addresses
            $table->text('permanent_address')->nullable();
            $table->text('current_address')->nullable();

            // Activities (multi-checkboxes)
            $table->json('activities')->nullable();
            $table->json('other_info')->nullable();

            // File uploads
            $table->string('university_id_doc')->nullable();
            $table->string('marksheet_doc')->nullable();
            $table->string('birth_certificate_doc')->nullable();
            $table->string('financial_certificate_doc')->nullable();
            $table->string('death_certificate_doc')->nullable();
            $table->string('medical_certificate_doc')->nullable();
            $table->string('activity_certificate_doc')->nullable();
            $table->string('signature_doc')->nullable();

            // Declaration
            $table->boolean('declaration_info_correct')->default(false);
            $table->boolean('declaration_will_stay')->default(false);
            $table->boolean('declaration_seven_days')->default(false);

            // Signature date
            $table->date('application_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seat_applications', function (Blueprint $table) {
            //
            $table->dropColumn([
                'student_name',
                'department',
                'roll_number',
                'academic_year',
                'guardian_name',
                'guardian_mobile',
                'guardian_relationship',
                'program',
                'semester_year',
                'semester_term',
                'physical_condition',
                'family_status',
                'permanent_address',
                'current_address',
                'activities',
                'other_info',
                'university_id_doc',
                'marksheet_doc',
                'birth_certificate_doc',
                'financial_certificate_doc',
                'death_certificate_doc',
                'medical_certificate_doc',
                'activity_certificate_doc',
                'signature_doc',
                'declaration_info_correct',
                'declaration_will_stay',
                'declaration_seven_days',
                'application_date'
            ]);
        });
    }
};
