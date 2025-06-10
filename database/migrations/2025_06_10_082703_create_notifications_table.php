<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_notifications_table.php
public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id('notification_id');
        $table->enum('user_type', ['student', 'admin']);
        $table->integer('user_id'); // student_id or admin_id
        $table->enum('type', ['application', 'seat_allotment', 'complaint', 'emergency', 'general']);
        $table->text('message');
        $table->enum('status', ['unread', 'read']);
        $table->timestamp('created_at');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
