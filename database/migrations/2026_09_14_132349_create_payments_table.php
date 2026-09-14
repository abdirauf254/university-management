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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // University that owns the payment
            $table->foreignId('university_id')
                ->constrained('universities')
                ->cascadeOnDelete();

            // Invoice being paid
            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->cascadeOnDelete();

            // Student making the payment
            $table->foreignId('student_id')
                ->constrained('student_profiles')
                ->cascadeOnDelete();

            // Payment reference/receipt number
            $table->string('payment_reference');

            // Amount paid in USD
            $table->decimal('amount', 12, 2);

            // Payment method
            $table->string('payment_method');

            // Date payment was made
            $table->date('payment_date');

            // Optional transaction reference from bank/payment provider
            $table->string('transaction_reference')->nullable();

            // Payment status
            $table->string('status')->default('completed');

            // Person who recorded the payment
            $table->foreignId('recorded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('university_id');

            $table->index('invoice_id');

            $table->index('student_id');

            $table->index('payment_date');

            $table->index([
                'university_id',
                'status',
            ]);

            // Payment references must be unique within each university
            $table->unique([
                'university_id',
                'payment_reference',
            ]);

            // Transaction references should not be duplicated
            $table->unique([
                'university_id',
                'transaction_reference',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};