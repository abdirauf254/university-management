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
        Schema::create('graduation_candidates', function (Blueprint $table) {
            $table->id();

            // University that owns the graduation candidate
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Graduation batch
            $table->foreignId('graduation_batch_id')
                ->constrained('graduation_batches')
                ->cascadeOnDelete();

            // Student
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Student's academic program enrollment
            $table->foreignId('student_program_enrollment_id')
                ->constrained('student_program_enrollments')
                ->cascadeOnDelete();

            // Final academic performance
            $table->decimal('final_cgpa', 4, 2)->nullable();

            // Academic classification
            $table->string('classification')->nullable();

            // Eligibility decision
            $table->string('eligibility_status')->default('pending');

            // Graduation status
            $table->string('graduation_status')->default('candidate');

            // User who approved the candidate
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Approval date/time
            $table->timestamp('approved_at')->nullable();

            // Additional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('graduation_batch_id');

            $table->index('student_id');

            $table->index('student_program_enrollment_id');

            $table->index('approved_by');

            $table->index([
                'university_id',
                'eligibility_status',
            ]);

            $table->index([
                'university_id',
                'graduation_status',
            ]);

            // A student enrollment can only appear once in a graduation batch
            $table->unique([
                'graduation_batch_id',
                'student_program_enrollment_id',
            ], 'graduation_batch_enrollment_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_candidates');
    }
};