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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();

            // University that owns this fee structure
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Optional program-specific fee
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('programs')
                ->nullOnDelete();

            // Academic year the fee applies to
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            // Optional semester-specific fee
            $table->foreignId('semester_id')
                ->nullable()
                ->constrained('semesters')
                ->nullOnDelete();

            // Fee name
            $table->string('name');

            // Fee category
            $table->string('category');

            // Fee amount in USD
            $table->decimal('amount', 12, 2);

            // Whether the fee is mandatory
            $table->boolean('is_mandatory')->default(true);

            // Fee status
            $table->string('status')->default('active');

            // Optional description
            $table->text('description')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('program_id');

            $table->index('academic_year_id');

            $table->index('semester_id');

            $table->index([
                'university_id',
                'status',
            ]);

            $table->index([
                'university_id',
                'category',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};