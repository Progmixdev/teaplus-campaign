<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'campaign_number',
        'phone',
        'campaign_id',
        'ip_address',
        'user_agent',
        'browser_data',
        'fingerprint',
    ];

    protected $casts = [
        'browser_data' => 'array',
    ];
}
