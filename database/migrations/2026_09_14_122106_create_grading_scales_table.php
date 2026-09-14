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
        Schema::create('grading_scales', function (Blueprint $table) {
            $table->id();

            // University that owns this grading scale
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Name of the grading system
            $table->string('name');

            // Mark range
            $table->decimal('min_mark', 5, 2);

            $table->decimal('max_mark', 5, 2);

            // Grade and corresponding grade point
            $table->string('grade');

            $table->decimal('grade_point', 4, 2);

            // Optional explanation
            $table->text('description')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index([
                'university_id',
                'min_mark',
                'max_mark',
            ]);

            $table->index([
                'university_id',
                'grade',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_scales');
    }
};