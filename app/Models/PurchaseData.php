<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseData extends Model
{
    protected $table = 'purchase_data';

    protected $fillable = [
        'name',
        'gender',
        'address',
        'telephone',
        'nid_front',
        'date',
        'date_of_birth',
        'email',
        'occupation',
        'nid_back',
    ];

    protected $casts = [
        'date' => 'date',
        'date_of_birth' => 'date',
    ];
}