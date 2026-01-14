<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamEvent extends Model
{
    protected $fillable = [
        'first_player_id',
        'second_player_id',
        'event_id',
    ];

    public function firstPlayer()
    {
        return $this->belongsTo(Player::class, 'first_player_id');
    }

    public function secondPlayer()
    {
        return $this->belongsTo(Player::class, 'second_player_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
