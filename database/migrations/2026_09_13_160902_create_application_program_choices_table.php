<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_program_choices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();

            $table->foreignId('program_id')
                ->constrained('programs')
                ->restrictOnDelete();

            $table->unsignedTinyInteger('choice_order');

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->unique(['application_id', 'program_id']);
            $table->unique(['application_id', 'choice_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_program_choices');
    }
};