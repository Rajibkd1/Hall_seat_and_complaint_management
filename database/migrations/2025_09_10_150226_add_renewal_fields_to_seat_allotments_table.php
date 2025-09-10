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
            $table->boolean('renewal_required')->default(false);
            $table->boolean('renewal_reminder_sent')->default(false);
            $table->date('renewal_deadline')->nullable();
            $table->date('allocation_expiry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seat_allotments', function (Blueprint $table) {
            $table->dropColumn([
                'renewal_required',
                'renewal_reminder_sent',
                'renewal_deadline',
                'allocation_expiry_date'
            ]);
        });
    }
};
