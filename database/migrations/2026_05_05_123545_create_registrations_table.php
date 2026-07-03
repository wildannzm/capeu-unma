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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('registration_number')->unique();
            $table->string('participant_type');
            $table->string('status')->default('draft');
            
            // JSON EAV Columns
            $table->json('personal_info')->nullable();
            $table->json('academic_info')->nullable();
            $table->json('participation_details')->nullable();
            $table->json('health_emergency')->nullable();
            $table->json('transportation')->nullable();
            $table->json('declaration')->nullable();
            $table->json('advanced_info')->nullable();

            // Document Paths
            $table->string('passport_path')->nullable();
            $table->string('student_card_path')->nullable();
            $table->string('formal_photo_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('motivation_letter_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
