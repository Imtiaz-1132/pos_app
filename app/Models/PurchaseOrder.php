<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'order_date',
        'reference_no',
        'location',
        'supplier',
        'pay_term',
        'address',
        'document',
        'items',
        'status',
        'quantity_remaining',
        'shipping_status',
        'shipping_details',
        'shipping_address',
        'shipping_charges',
        'delivered_to',
        'shipping_document',
        'additional_expenses',
        'order_total',
        'added_by',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'quantity_remaining' => 'integer',
        'items' => 'array',
        'shipping_charges' => 'decimal:2',
        'additional_expenses' => 'decimal:2',
        'order_total' => 'decimal:2',
    ];
}