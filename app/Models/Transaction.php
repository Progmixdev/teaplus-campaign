<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'campaign_number',
        'phone_number',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
