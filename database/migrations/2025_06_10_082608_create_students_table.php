<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_students_table.php
public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id('student_id');
        $table->string('name');
        $table->string('university_id');
        $table->string('profile_image')->nullable();
        $table->string('university_id_card_image')->nullable();
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('department');
        $table->integer('session_year');
        $table->string('current_address');
        $table->string('permanent_address');
        $table->string('father_name');
        $table->string('mother_name');
        $table->string('other_guardian')->nullable();
        $table->boolean('guardian_alive_status');
        $table->string('guardian_contact');
        $table->string('password_hash');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
