<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            $table->foreignId('course_offering_id')
                ->constrained('course_offerings')
                ->cascadeOnDelete();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->restrictOnDelete();

            /*
             * 1 = Monday
             * 2 = Tuesday
             * 3 = Wednesday
             * 4 = Thursday
             * 5 = Friday
             */
            $table->unsignedTinyInteger('day_of_week');

            $table->time('start_time');

            $table->time('end_time');

            $table->timestamps();

            $table->index('university_id');

            $table->index('course_offering_id');

            $table->index('room_id');

            $table->index([
                'university_id',
                'day_of_week',
                'start_time'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};