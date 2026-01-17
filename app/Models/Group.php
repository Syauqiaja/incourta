<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'event_id',
        'name',

    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function teams()
    {
        return $this->belongsToMany(
            TeamEvent::class,
            'group_teams',
            'group_id',
            'team_event_id'
        );
    }
}
