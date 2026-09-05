<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier',
        'reference_no',
        'purchase_date',
        'location',
        'payment_status',
        'payment_method',
        'total_amount',
        'paid_amount',
        'due_amount',
        'document',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
    ];
}