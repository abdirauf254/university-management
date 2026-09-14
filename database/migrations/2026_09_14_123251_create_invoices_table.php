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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // University that owns the invoice
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Student who owes the invoice
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Academic period
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            $table->foreignId('semester_id')
                ->constrained('semesters')
                ->cascadeOnDelete();

            // Unique invoice number
            $table->string('invoice_number');

            // Invoice dates
            $table->date('issue_date');

            $table->date('due_date');

            // Financial totals in USD
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->decimal('discount', 12, 2)->default(0);

            $table->decimal('total_amount', 12, 2)->default(0);

            $table->decimal('paid_amount', 12, 2)->default(0);

            $table->decimal('balance', 12, 2)->default(0);

            // Invoice status
            $table->string('status')->default('unpaid');

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('student_id');

            $table->index('academic_year_id');

            $table->index('semester_id');

            $table->index([
                'university_id',
                'status',
            ]);

            $table->index([
                'university_id',
                'due_date',
            ]);

            // Invoice numbers must be unique within each university
            $table->unique([
                'university_id',
                'invoice_number',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};