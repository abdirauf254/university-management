<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_offerings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->restrictOnDelete();

            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->restrictOnDelete();

            $table->foreignId('semester_id')
                ->constrained('semesters')
                ->restrictOnDelete();

            $table->string('section')->default('A');

            $table->unsignedInteger('capacity')->nullable();

            $table->string('status')->default('planned');

            $table->timestamps();

            $table->unique([
                'course_id',
                'semester_id',
                'section'
            ]);

            $table->index('university_id');
            $table->index('course_id');
            $table->index('academic_year_id');
            $table->index('semester_id');

            $table->index([
                'university_id',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_offerings');
    }
};