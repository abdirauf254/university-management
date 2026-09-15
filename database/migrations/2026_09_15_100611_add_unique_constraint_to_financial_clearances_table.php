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
        Schema::table('financial_clearances', function (Blueprint $table) {
            $table->unique(
                [
                    'university_id',
                    'student_id',
                    'academic_year_id',
                    'semester_id',
                ],
                'fin_clearance_student_period_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_clearances', function (Blueprint $table) {
            $table->dropUnique('fin_clearance_student_period_unique');
        });
    }
};