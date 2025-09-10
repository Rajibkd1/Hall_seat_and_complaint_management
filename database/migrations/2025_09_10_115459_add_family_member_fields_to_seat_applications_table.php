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
            // Family Member Information
            $table->string('family_member')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('mother_profession')->nullable();
            $table->string('other_guardian')->nullable();
            $table->decimal('guardian_monthly_income', 10, 2)->nullable();

            // Replace semester_year and semester_term with number_of_semester
            $table->integer('number_of_semester')->nullable();

            // Additional document uploads for "Others" category
            $table->string('other_doc_1')->nullable();
            $table->string('other_doc_2')->nullable();
            $table->string('other_doc_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seat_applications', function (Blueprint $table) {
            $table->dropColumn([
                'family_member',
                'father_name',
                'mother_name',
                'father_profession',
                'mother_profession',
                'other_guardian',
                'guardian_monthly_income',
                'number_of_semester',
                'other_doc_1',
                'other_doc_2',
                'other_doc_3'
            ]);
        });
    }
};
