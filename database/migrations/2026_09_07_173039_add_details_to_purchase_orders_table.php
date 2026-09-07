<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {

            $table->string('pay_term')->nullable()->after('supplier');

            $table->text('address')->nullable()->after('pay_term');

            $table->string('document')->nullable()->after('address');

            $table->json('items')->nullable()->after('document');

            $table->text('shipping_details')->nullable()->after('items');

            $table->text('shipping_address')->nullable()->after('shipping_details');

            $table->decimal('shipping_charges', 15, 2)
                ->default(0)
                ->after('shipping_address');

            $table->string('delivered_to')->nullable()->after('shipping_charges');

            $table->string('shipping_document')
                ->nullable()
                ->after('delivered_to');

            $table->decimal('additional_expenses', 15, 2)
                ->default(0)
                ->after('shipping_document');

            $table->decimal('order_total', 15, 2)
                ->default(0)
                ->after('additional_expenses');
        });
    }

    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {

            $table->dropColumn([
                'pay_term',
                'address',
                'document',
                'items',
                'shipping_details',
                'shipping_address',
                'shipping_charges',
                'delivered_to',
                'shipping_document',
                'additional_expenses',
                'order_total',
            ]);
        });
    }
};