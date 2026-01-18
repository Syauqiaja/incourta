<?php

namespace App\Models;

use App\Enums\EventStatus;
use App\EventType;
use App\MatchCategories;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Sluggable;
    
    protected $fillable = [
        'title',
        'slug',
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
        'status' => EventStatus::class,
        'category' => MatchCategories::class,
        'event_type' => EventType::class,
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
