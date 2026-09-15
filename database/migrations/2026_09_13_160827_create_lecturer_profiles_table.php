<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->restrictOnDelete();

            $table->string('employee_number');

            $table->string('phone')->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();

            $table->date('joining_date')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();

            $table->unique('user_id');
            $table->unique(['university_id', 'employee_number']);
            $table->index('department_id');
            $table->index(['university_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_profiles');
    }
};