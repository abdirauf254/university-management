<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('university_settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->string('timezone')->default('UTC');
            $table->string('currency')->default('USD');

            $table->unsignedTinyInteger('academic_year_start_month')
                ->default(9);

            $table->string('grading_system')->default('standard');
            $table->string('transcript_format')->default('standard');

            $table->boolean('attendance_enabled')->default(true);
            $table->boolean('finance_enabled')->default(true);
            $table->boolean('examination_enabled')->default(true);

            $table->timestamps();

            $table->unique('university_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('university_settings');
    }
};