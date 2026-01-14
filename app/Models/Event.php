<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'event_type',
        'description',
        'image',
        'start_time',
        'end_time',
        'location',
        'created_by',
        'max_participants',
        'max_group',
        'max_participants_in_group',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
