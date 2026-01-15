<?php

namespace App\Models;

use App\Enum\FixtureStatus;
use App\EventType;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'event_id',
        'round',
    ];
    protected $casts = [
        'event_type' => EventType::class,
        'status' => FixtureStatus::class,
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
