<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_complaint_actions_table.php
public function up()
{
    Schema::create('complaint_actions', function (Blueprint $table) {
        $table->id('action_id');
        $table->foreignId('complaint_id')->constrained('complaints');
        $table->foreignId('admin_id')->constrained('admins');
        $table->enum('action_type', ['response', 'closure', 'escalation']);
        $table->text('notes');
        $table->timestamp('timestamp');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_actions');
    }
};
