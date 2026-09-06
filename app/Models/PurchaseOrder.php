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
        'status',
        'quantity_remaining',
        'shipping_status',
        'added_by',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'date',
        'quantity_remaining' => 'integer',
    ];
}