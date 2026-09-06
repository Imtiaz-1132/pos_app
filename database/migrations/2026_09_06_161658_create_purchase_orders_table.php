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
        Schema::create('purchase_orders', function (Blueprint $table) {

            $table->id();

            // Purchase Order information
            $table->date('order_date');
            $table->string('reference_no')->unique();

            // Business information
            $table->string('location');
            $table->string('supplier');

            // Order status
            $table->enum('status', [
                'pending',
                'approved',
                'completed',
                'cancelled'
            ])->default('pending');

            // Quantity
            $table->integer('quantity_remaining')->default(0);

            // Shipping
            $table->enum('shipping_status', [
                'pending',
                'partial',
                'shipped',
                'received'
            ])->default('pending');

            // User who created the order
            $table->string('added_by')->nullable();

            // Additional information
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};