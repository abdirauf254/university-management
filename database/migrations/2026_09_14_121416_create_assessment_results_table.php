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
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->id();

            // Assessment
            $table->foreignId('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();

            // Student who received the mark
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Mark obtained
            $table->decimal('marks', 6, 2);

            /*
             * Status values:
             * draft
             * submitted
             * approved
             * published
             * rejected
             */
            $table->string('status')->default('draft');

            // Optional lecturer/examiner remarks
            $table->text('remarks')->nullable();

            // User who recorded the mark
            $table->foreignId('recorded_by')
                ->constrained('users')
                ->restrictOnDelete();

            // When the mark was recorded
            $table->timestamp('recorded_at')->nullable();

            $table->timestamps();

            // A student can have only one result
            // for a particular assessment.
            $table->unique([
                'assessment_id',
                'student_id',
            ]);

            // Indexes
            $table->index('assessment_id');
            $table->index('student_id');
            $table->index('recorded_by');

            $table->index([
                'assessment_id',
                'status',
            ]);

            $table->index([
                'student_id',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_results');
    }
};