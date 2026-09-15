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
        Schema::create('financial_clearances', function (Blueprint $table) {
            $table->id();

            // University that owns the clearance record
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Student being financially cleared
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Academic year for this clearance
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            // Semester for this clearance
            $table->foreignId('semester_id')
                ->constrained('semesters')
                ->cascadeOnDelete();

            // Financial amounts in USD
            $table->decimal('total_billed', 12, 2)->default(0);
            $table->decimal('total_paid', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);

            // Clearance status
            $table->string('status')->default('pending');

            // When the student was officially cleared
            $table->timestamp('cleared_at')->nullable();

            // Staff member who approved the clearance
            $table->foreignId('cleared_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional remarks
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('student_id');

            $table->index('academic_year_id');

            $table->index('semester_id');

            $table->index('cleared_by');

            $table->index([
                'university_id',
                'status',
            ]);

            // One clearance record per student per academic period
            $table->unique([
                'university_id',
                'student_id',
                'academic_year_id',
                'semester_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_clearances');
    }
};