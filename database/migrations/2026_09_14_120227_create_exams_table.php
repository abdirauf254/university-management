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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            // University ownership
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Academic period
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            $table->foreignId('semester_id')
                ->constrained('semesters')
                ->cascadeOnDelete();

            // Exam information
            $table->string('name');

            $table->string('type');

            $table->date('start_date');

            $table->date('end_date');

            /*
             * Status values:
             * draft
             * scheduled
             * ongoing
             * completed
             * published
             * cancelled
             */
            $table->string('status')->default('draft');

            $table->timestamps();

            // Indexes
            $table->index('university_id');
            $table->index('academic_year_id');
            $table->index('semester_id');

            $table->index([
                'university_id',
                'status',
            ]);

            $table->index([
                'university_id',
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
        Schema::dropIfExists('exams');
    }
};