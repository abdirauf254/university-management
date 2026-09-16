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
        Schema::create('student_clearances', function (Blueprint $table) {
            $table->id();

            // University that owns the clearance record
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Graduation candidate
            $table->foreignId('graduation_candidate_id')
                ->constrained('graduation_candidates')
                ->cascadeOnDelete();

            // Type of clearance
            $table->foreignId('clearance_type_id')
                ->constrained('clearance_types')
                ->cascadeOnDelete();

            // Clearance status
            $table->string('status')->default('pending');

            // User who cleared/approved the student
            $table->foreignId('cleared_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Date/time the clearance was completed
            $table->timestamp('cleared_at')->nullable();

            // Additional remarks
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('graduation_candidate_id');

            $table->index('clearance_type_id');

            $table->index('cleared_by');

            $table->index([
                'university_id',
                'status',
            ]);

            // A candidate can have only one record
            // for each clearance type
            $table->unique([
                'graduation_candidate_id',
                'clearance_type_id',
            ], 'student_clearance_candidate_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_clearances');
    }
};