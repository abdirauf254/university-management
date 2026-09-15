<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('student_number');
            $table->string('admission_number')->nullable();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();

            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->date('admission_date')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();

            $table->unique('user_id');
            $table->unique(['university_id', 'student_number']);
            $table->index(['university_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};