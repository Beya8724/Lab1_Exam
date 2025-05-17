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
        Schema::create('students', function (Blueprint $table) {
            $table->id();                      // Auto-increment ID (primary key)
            $table->string('student_id');      // Student ID (e.g., 2025-0001)
            $table->string('name');            // Student name
            $table->string('email');           // Email address
            $table->string('course');          // Course name
            $table->timestamps();              // created_at and updated_at
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
