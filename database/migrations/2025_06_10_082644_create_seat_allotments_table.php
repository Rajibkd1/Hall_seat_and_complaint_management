<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_seat_allotments_table.php
public function up()
{
    Schema::create('seat_allotments', function (Blueprint $table) {
        $table->id('allotment_id');
        $table->foreignId('seat_id')->constrained('seats');
        $table->foreignId('student_id')->constrained('students');
        $table->foreignId('application_id')->constrained('seat_applications');
        $table->foreignId('admin_id')->constrained('admins');
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->enum('status', ['active', 'ended', 'transferred']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_allotments');
    }
};
