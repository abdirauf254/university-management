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
        Schema::create('exam_courses', function (Blueprint $table) {
            $table->id();

            // Exam
            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            // Specific course offering being examined
            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->cascadeOnDelete();

            // Examination schedule
            $table->date('exam_date');

            $table->time('start_time');

            $table->time('end_time');

            // Examination room
            $table->foreignId('room_id')
                ->nullable()
                ->constrained('rooms')
                ->nullOnDelete();

            // Marks
            $table->decimal('total_marks', 6, 2);

            $table->decimal('pass_marks', 6, 2);

            /*
             * Status values:
             * scheduled
             * ongoing
             * completed
             * cancelled
             */
            $table->string('status')->default('scheduled');

            $table->timestamps();

            // Prevent the same course offering
            // from being added to the same exam twice.
            $table->unique([
                'exam_id',
                'course_offering_id',
            ]);

            // Indexes
            $table->index('exam_id');
            $table->index('course_offering_id');
            $table->index('room_id');

            $table->index([
                'exam_id',
                'exam_date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_courses');
    }
};