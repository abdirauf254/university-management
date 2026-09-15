<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculum_courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curriculum_id')
                ->constrained('curricula')
                ->cascadeOnDelete();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->restrictOnDelete();

            $table->unsignedTinyInteger('year_of_study');
            $table->unsignedTinyInteger('semester_number');

            $table->boolean('is_core')->default(true);

            $table->decimal('credit_hours', 5, 2);

            $table->timestamps();

            $table->unique(['curriculum_id', 'course_id']);
            $table->index('course_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculum_courses');
    }
};