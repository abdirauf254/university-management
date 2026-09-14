<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_offering_lecturers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->cascadeOnDelete();

            $table->foreignId('lecturer_id')
                ->constrained('lecturer_profiles')
                ->restrictOnDelete();

            $table->string('role')->default('primary');

            $table->timestamps();

            $table->unique([
                'course_offering_id',
                'lecturer_id'
            ]);

            $table->index('course_offering_id');
            $table->index('lecturer_id');
            $table->index([
                'course_offering_id',
                'role'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_offering_lecturers');
    }
};