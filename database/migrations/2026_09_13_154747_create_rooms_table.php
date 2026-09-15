<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('campus_id')
                ->constrained('campuses')
                ->cascadeOnDelete();

            $table->string('building')->nullable();
            $table->string('name');

            $table->unsignedInteger('capacity');

            $table->string('status')->default('active');

            $table->timestamps();

            $table->index(['university_id', 'campus_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};