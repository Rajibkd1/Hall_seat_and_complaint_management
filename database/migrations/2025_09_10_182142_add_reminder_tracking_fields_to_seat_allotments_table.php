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
            // Add individual reminder tracking fields
            $table->boolean('reminder_29_days_sent')->default(false);
            $table->boolean('reminder_20_days_sent')->default(false);
            $table->boolean('reminder_10_days_sent')->default(false);
            $table->timestamp('reminder_29_days_sent_at')->nullable();
            $table->timestamp('reminder_20_days_sent_at')->nullable();
            $table->timestamp('reminder_10_days_sent_at')->nullable();
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
