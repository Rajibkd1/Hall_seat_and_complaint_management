<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_hall_notices_table.php
public function up()
{
    Schema::create('hall_notices', function (Blueprint $table) {
        $table->id('notice_id');
        $table->string('title');
        $table->enum('notice_type', ['announcement', 'event', 'deadline']);
        $table->text('description');
        $table->timestamp('date_posted');
        $table->unsignedBigInteger('admin_id');
        $table->foreign('admin_id')->references('admin_id')->on('admins')->onDelete('cascade');
        $table->timestamp('valid_from')->nullable();
        $table->timestamp('valid_until')->nullable();
        $table->enum('status', ['active', 'expired']);
        $table->string('attachment')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_notices');
    }
};
