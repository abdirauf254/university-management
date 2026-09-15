<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            $table->string('name');

            $table->unsignedTinyInteger('number');

            $table->date('start_date');
            $table->date('end_date');

            $table->boolean('is_current')->default(false);

            $table->string('status')->default('active');

            $table->timestamps();

            $table->unique(['academic_year_id', 'number']);
            $table->index(['university_id', 'is_current']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};