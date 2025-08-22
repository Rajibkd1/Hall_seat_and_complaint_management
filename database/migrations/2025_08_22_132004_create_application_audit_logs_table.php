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
        Schema::create('application_audit_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('action_type'); // e.g., 'status_update', 'note_added'
            $table->string('old_status')->nullable();
            $table->string('new_status')->nullable();
            $table->text('message')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('application_id')
                  ->references('application_id')
                  ->on('seat_applications')
                  ->onDelete('cascade');
                  
            $table->foreign('admin_id')
                  ->references('admin_id')
                  ->on('admins')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_audit_logs');
    }
};
