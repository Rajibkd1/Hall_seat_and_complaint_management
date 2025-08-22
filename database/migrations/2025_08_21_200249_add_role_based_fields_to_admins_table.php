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
        Schema::table('admins', function (Blueprint $table) {
            // Role-based fields
            $table->enum('role_type', ['provost', 'co_provost', 'staff'])->after('role');
            $table->string('designation')->nullable()->after('role_type');
            $table->string('hall_name')->nullable()->after('designation');
            $table->string('contact_number')->nullable()->after('hall_name');
            
            // Verification and creation tracking
            $table->boolean('is_verified')->default(false)->after('contact_number');
            $table->unsignedBigInteger('created_by')->nullable()->after('is_verified');
            $table->timestamp('verified_at')->nullable()->after('created_by');
            
            // Add foreign key constraint
            $table->foreign('created_by')->references('admin_id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn([
                'role_type',
                'designation', 
                'hall_name',
                'contact_number',
                'is_verified',
                'created_by',
                'verified_at'
            ]);
        });
    }
};
