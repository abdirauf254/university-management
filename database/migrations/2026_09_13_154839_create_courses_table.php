<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->cascadeOnDelete();

            $table->string('code');
            $table->string('name');

            $table->text('description')->nullable();

            $table->decimal('credit_hours', 5, 2);

            $table->string('level')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();

            $table->unique(['university_id', 'code']);
            $table->index('department_id');
            $table->index(['university_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};