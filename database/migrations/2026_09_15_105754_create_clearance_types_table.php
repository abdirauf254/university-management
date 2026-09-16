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
        Schema::create('clearance_types', function (Blueprint $table) {
            $table->id();

            // University that owns this clearance type
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Clearance type name
            $table->string('name');

            // Unique clearance code within each university
            $table->string('code');

            // Optional description
            $table->text('description')->nullable();

            // Whether students must complete this clearance before graduation
            $table->boolean('is_required')->default(true);

            // Active/inactive
            $table->string('status')->default('active');

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index([
                'university_id',
                'status',
            ]);

            $table->index([
                'university_id',
                'is_required',
            ]);

            // Clearance code must be unique within each university
            $table->unique([
                'university_id',
                'code',
            ], 'clearance_type_university_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_types');
    }
};