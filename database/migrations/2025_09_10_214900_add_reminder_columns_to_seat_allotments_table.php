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
        Schema::table('seat_allotments', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('seat_allotments', 'reminder_29_days_sent')) {
                $table->boolean('reminder_29_days_sent')->default(false);
            }
            if (!Schema::hasColumn('seat_allotments', 'reminder_20_days_sent')) {
                $table->boolean('reminder_20_days_sent')->default(false);
            }
            if (!Schema::hasColumn('seat_allotments', 'reminder_10_days_sent')) {
                $table->boolean('reminder_10_days_sent')->default(false);
            }
            if (!Schema::hasColumn('seat_allotments', 'reminder_29_days_sent_at')) {
                $table->timestamp('reminder_29_days_sent_at')->nullable();
            }
            if (!Schema::hasColumn('seat_allotments', 'reminder_20_days_sent_at')) {
                $table->timestamp('reminder_20_days_sent_at')->nullable();
            }
            if (!Schema::hasColumn('seat_allotments', 'reminder_10_days_sent_at')) {
                $table->timestamp('reminder_10_days_sent_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seat_allotments', function (Blueprint $table) {
            $table->dropColumn([
                'reminder_29_days_sent',
                'reminder_20_days_sent',
                'reminder_10_days_sent',
                'reminder_29_days_sent_at',
                'reminder_20_days_sent_at',
                'reminder_10_days_sent_at'
            ]);
        });
    }
};
