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
        Schema::create('course_results', function (Blueprint $table) {
            $table->id();

            // University ownership
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Student receiving the course result
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Course offering being graded
            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->cascadeOnDelete();

            // Final calculated course mark
            $table->decimal('total_marks', 6, 2)->nullable();

            // Grade obtained, e.g. A, B+, C
            $table->string('grade')->nullable();

            // Grade point used for GPA/CGPA calculation
            $table->decimal('grade_point', 4, 2)->nullable();

            /*
             * Result workflow:
             * draft
             * submitted
             * hod_approved
             * exam_approved
             * published
             * rejected
             */
            $table->string('status')->default('draft');

            // Optional academic remarks
            $table->text('remarks')->nullable();

            // User who recorded/submitted the result
            $table->foreignId('recorded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // User who approved the result
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Approval timestamp
            $table->timestamp('approved_at')->nullable();

            // Publication timestamp
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            // One result per student for each course offering.
            $table->unique([
                'student_id',
                'course_offering_id',
            ]);

            // Indexes
            $table->index('university_id');
            $table->index('student_id');
            $table->index('course_offering_id');
            $table->index('recorded_by');
            $table->index('approved_by');

            $table->index([
                'university_id',
                'status',
            ]);

            $table->index([
                'student_id',
                'status',
            ]);

            $table->index([
                'course_offering_id',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_results');
    }
};