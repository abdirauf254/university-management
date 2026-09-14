<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->cascadeOnDelete();

            $table->foreignId('timetable_id')
                ->nullable()
                ->constrained('timetables')
                ->nullOnDelete();

            $table->date('session_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->foreignId('recorded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('status')->default('open');

            $table->timestamps();

            $table->index('university_id');

            $table->index('course_offering_id');

            $table->index('timetable_id');

            $table->index('session_date');

            $table->index([
                'university_id',
                'session_date'
            ]);

            $table->index([
                'course_offering_id',
                'session_date'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_sessions');
    }
};