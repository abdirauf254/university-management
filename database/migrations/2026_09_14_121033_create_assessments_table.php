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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();

            // University ownership
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Specific course offering
            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->cascadeOnDelete();

            // Assessment information
            $table->string('name');

            /*
             * Assessment types:
             * assignment
             * quiz
             * cat
             * midterm
             * project
             * practical
             * final_exam
             * other
             */
            $table->string('type');

            // Percentage contribution to the final course mark
            $table->decimal('weight', 5, 2);

            // Maximum marks for this assessment
            $table->decimal('max_marks', 6, 2);

            // Optional date on which the assessment takes place
            $table->date('assessment_date')->nullable();

            /*
             * Status values:
             * draft
             * published
             * closed
             * cancelled
             */
            $table->string('status')->default('draft');

            $table->timestamps();

            // Indexes
            $table->index('university_id');
            $table->index('course_offering_id');

            $table->index([
                'university_id',
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
        Schema::dropIfExists('assessments');
    }
};