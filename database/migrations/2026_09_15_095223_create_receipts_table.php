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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();

            // University that owns the receipt
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Payment for which this receipt was issued
            $table->foreignId('payment_id')
                ->constrained('payments')
                ->cascadeOnDelete();

            // Student who received the receipt
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Unique receipt number
            $table->string('receipt_number');

            // Receipt amount in USD
            $table->decimal('amount', 12, 2);

            // Date receipt was issued
            $table->date('receipt_date');

            // Optional path to generated PDF receipt
            $table->string('file_path')->nullable();

            // Person who issued/generated the receipt
            $table->foreignId('issued_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Receipt status
            $table->string('status')->default('issued');

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('payment_id');

            $table->index('student_id');

            $table->index('receipt_date');

            $table->index([
                'university_id',
                'status',
            ]);

            // Receipt numbers must be unique within each university
            $table->unique([
                'university_id',
                'receipt_number',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};