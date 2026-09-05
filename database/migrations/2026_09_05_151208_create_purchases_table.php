<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->string('supplier');
            $table->string('reference_no')->unique();

            $table->date('purchase_date');

            $table->string('location');

            $table->enum('payment_status', [
                'paid',
                'partial',
                'pending'
            ])->default('pending');

            $table->string('payment_method')->nullable();

            $table->decimal('total_amount', 15, 2)->default(0);

            $table->decimal('paid_amount', 15, 2)->default(0);

            $table->decimal('due_amount', 15, 2)->default(0);

            $table->string('document')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};