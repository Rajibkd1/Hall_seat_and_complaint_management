<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_seats_table.php
public function up()
{
    Schema::create('seats', function (Blueprint $table) {
        $table->id('seat_id');
        $table->string('room_number');
        $table->string('bed_number');
        $table->enum('status', ['vacant', 'occupied', 'maintenance']);
        $table->timestamp('last_updated');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
