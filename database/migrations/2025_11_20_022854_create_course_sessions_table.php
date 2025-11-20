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
        Schema::create('course_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->text('description')->nullable();

            // Session type
            $table->enum('session_type', ['online', 'offline'])->default('online');

            // For online sessions
            $table->string('meeting_link')->nullable();
            $table->string('meeting_id')->nullable(); // Zoom meeting ID
            $table->string('meeting_password')->nullable();

            // For offline sessions
            $table->string('location_name')->nullable();
            $table->text('location_address')->nullable();

            // Schedule
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('duration_minutes')->nullable();

            // Capacity
            $table->integer('max_participants')->nullable();

            // Status
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');

            // Recording (for online sessions)
            $table->string('recording_url')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('course_id')->references('courseID')->on('courses')->onDelete('cascade');

            // Index for performance
            $table->index(['course_id', 'start_time']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_sessions');
    }
};
