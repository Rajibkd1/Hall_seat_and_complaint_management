<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'verified' status to the enum
        DB::statement("ALTER TABLE seat_applications MODIFY COLUMN status ENUM('pending', 'approved', 'verified', 'rejected', 'waitlisted', 'allocated') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'verified' status from the enum
        DB::statement("ALTER TABLE seat_applications MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'waitlisted', 'allocated') NOT NULL");
    }
};
