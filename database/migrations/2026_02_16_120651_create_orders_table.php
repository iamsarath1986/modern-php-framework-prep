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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Foreign Key to Users
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            // Order Details
            $table->string('order_number')->unique(); // e.g., ORD-2024-001
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            // Status (using string columns is simpler than enums for learning)
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled
            $table->string('payment_status')->default('unpaid'); // unpaid, paid, failed
            // Timestamps
            $table->timestamps();

            // Indexes for performance (optional but good practice)
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
