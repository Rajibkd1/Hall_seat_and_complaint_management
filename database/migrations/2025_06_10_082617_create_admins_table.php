<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/{timestamp}_create_admins_table.php
public function up()
{
    Schema::create('admins', function (Blueprint $table) {
        $table->id('admin_id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('role');
        $table->string('department');
        $table->string('teacher_id')->nullable();
        $table->string('password_hash');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
