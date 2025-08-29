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
            $table->string('division')->nullable()->after('family_status');
            $table->string('district')->nullable()->after('division');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seat_applications', function (Blueprint $table) {
            $table->dropColumn(['division', 'district']);
        });
    }
};
