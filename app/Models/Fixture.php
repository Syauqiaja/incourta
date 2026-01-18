<?php

namespace App\Models;

use App\Enums\FixtureStatus;
use App\Enums\ScoringType;
use App\EventType;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'event_id',
        'event_type',
        'group_id',
        'round_name',
        'first_team_id',
        'second_team_id',
        'winner_team_id',
        'scoring_type',
        'status',
    ];
    protected $casts = [
        'event_type' => EventType::class,
        'status' => FixtureStatus::class,
        'scoring_type' => ScoringType::class,
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function firstTeam()
    {
        return $this->belongsTo(TeamEvent::class, 'first_team_id');
    }
    public function secondTeam()
    {
        return $this->belongsTo(TeamEvent::class, 'second_team_id');
    }
    public function winnerTeam()
    {
        return $this->belongsTo(TeamEvent::class, 'winner_team_id');
    }
}
