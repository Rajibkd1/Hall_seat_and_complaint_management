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
        $table->unsignedBigInteger('seat_id');
        $table->foreign('seat_id')->references('seat_id')->on('seats')->onDelete('cascade');

        $table->unsignedBigInteger('student_id');
        $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

        $table->unsignedBigInteger('application_id');
        $table->foreign('application_id')->references('application_id')->on('seat_applications')->onDelete('cascade');

        $table->unsignedBigInteger('admin_id');
        $table->foreign('admin_id')->references('admin_id')->on('admins')->onDelete('cascade');

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
