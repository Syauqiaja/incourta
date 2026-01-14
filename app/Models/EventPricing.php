<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPricing extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'start_date',
        'end_date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
