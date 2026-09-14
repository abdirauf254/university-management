<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->restrictOnDelete();

            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->restrictOnDelete();

            $table->timestamp('registered_at')->useCurrent();

            $table->string('status')->default('pending');

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamp('dropped_at')->nullable();

            $table->timestamps();

            /*
             * A student cannot register for the same
             * course offering more than once.
             */
            $table->unique([
                'student_id',
                'course_offering_id'
            ]);

            $table->index('university_id');
            $table->index('student_id');
            $table->index('course_offering_id');
            $table->index([
                'university_id',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};