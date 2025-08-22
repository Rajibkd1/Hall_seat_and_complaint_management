<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix the status enum to include 'allocated' if it's missing
        DB::statement("ALTER TABLE seat_applications MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'waitlisted', 'allocated') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum without 'allocated'
        DB::statement("ALTER TABLE seat_applications MODIFY COLUMN status ENUM('pending', 'approved', 'rejected', 'waitlisted') NOT NULL");
    }
};
