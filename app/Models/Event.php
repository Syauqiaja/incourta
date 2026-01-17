<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'event_type',
        'status',
        'description',
        'image',
        'start_time',
        'end_time',
        'location',
        'created_by',
        'max_participants',
        'max_group',
        'max_participants_in_group',
        'category',
        'prize_pool',
        'registration_deadline',
        'points_win',
        'points_lose',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'registration_deadline' => 'datetime',
    ];

    public function teams()
    {
        return $this->hasMany(TeamEvent::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
    public function pricings()
    {
        return $this->hasMany(EventPricing::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
