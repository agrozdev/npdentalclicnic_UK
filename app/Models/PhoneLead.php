<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneLead extends Model
{
    protected $fillable = [
        'vapi_call_id',
        'caller_number',
        'name',
        'email',
        'reason',
        'preferred_time',
        'recording_url',
        'transcript',
        'messages',
        'summary',
        'ended_reason',
        'call_started_at',
        'call_ended_at',
        'status',
    ];

    protected $casts = [
        'messages'        => 'array',
        'call_started_at' => 'datetime',
        'call_ended_at'   => 'datetime',
    ];
}
