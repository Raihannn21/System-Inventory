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
            $table->id();
            $table->foreignId('program_study_id')->constrained();
            $table->foreignId('school_class_id')->constrained();
            $table->string('identification_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('program_study_id')->nullable()->change();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('school_class_id')->nullable()->change();
        });
        
        Schema::table('students', function (Blueprint $table) {
            $table->string('identification_number')->nullable()->change();
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
