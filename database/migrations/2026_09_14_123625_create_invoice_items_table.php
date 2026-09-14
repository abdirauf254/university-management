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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            // Invoice this item belongs to
            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->cascadeOnDelete();

            // Optional link to the fee structure
            $table->foreignId('fee_structure_id')
                ->nullable()
                ->constrained('fee_structures')
                ->nullOnDelete();

            // Description of the charge
            $table->string('description');

            // Quantity of the charge
            $table->decimal('quantity', 8, 2)->default(1);

            // Unit price in USD
            $table->decimal('unit_price', 12, 2);

            // Total amount in USD
            $table->decimal('amount', 12, 2);

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('invoice_id');

            $table->index('fee_structure_id');

            $table->index([
                'invoice_id',
                'fee_structure_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};