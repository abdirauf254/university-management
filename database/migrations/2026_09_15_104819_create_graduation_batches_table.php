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
        Schema::create('graduation_batches', function (Blueprint $table) {
            $table->id();

            // University that owns the graduation batch
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Academic year associated with the graduation
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            // Graduation batch name
            $table->string('name');

            // Unique batch code within each university
            $table->string('code');

            // Official graduation/ceremony date
            $table->date('graduation_date');

            // Optional description
            $table->text('description')->nullable();

            // Graduation batch status
            $table->string('status')->default('planned');

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('academic_year_id');

            $table->index('graduation_date');

            $table->index([
                'university_id',
                'status',
            ]);

            // Batch code must be unique within each university
            $table->unique([
                'university_id',
                'code',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_batches');
    }
};