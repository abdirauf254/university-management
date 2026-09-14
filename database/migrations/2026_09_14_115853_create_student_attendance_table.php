<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_attendance', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attendance_session_id')
                ->constrained('attendance_sessions')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->restrictOnDelete();

            $table->string('status')->default('present');

            $table->text('remarks')->nullable();

            $table->timestamps();

            /*
             * A student can only have one attendance
             * record for the same attendance session.
             */
            $table->unique([
                'attendance_session_id',
                'student_id'
            ]);

            $table->index('attendance_session_id');

            $table->index('student_id');

            $table->index([
                'student_id',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_attendance');
    }
};