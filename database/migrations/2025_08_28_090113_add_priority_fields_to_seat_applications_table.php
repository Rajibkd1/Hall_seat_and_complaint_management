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
            $table->integer('years_completed')->default(0); // years completed in university
            $table->integer('extracurricular_count')->default(0); // number of extracurricular activities
            $table->boolean('guardian_deceased')->default(false); // whether guardian is deceased
            $table->decimal('priority_score', 5, 2)->default(0.00); // priority score as percentage
            $table->json('score_breakdown')->nullable(); // detailed breakdown of scoring
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seat_applications', function (Blueprint $table) {
            $table->dropColumn([
                'years_completed',
                'extracurricular_count',
                'guardian_deceased',
                'priority_score',
                'score_breakdown'
            ]);
        });
    }
};
