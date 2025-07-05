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
        Schema::table('students', function (Blueprint $table) {
            //
            $table->string('current_address')->nullable()->change();
            $table->string('permanent_address')->nullable()->change();
            $table->string('father_name')->nullable()->change();
            $table->string('mother_name')->nullable()->change();
            $table->string('other_guardian')->nullable()->change();
            $table->boolean('guardian_alive_status')->nullable()->change();
            $table->string('guardian_contact')->nullable()->change();
            $table->string('profile_image')->nullable()->change();
            $table->string('university_id_card_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
