<?php

namespace App\Models;

use App\Enums\ScoreSource;
use Illuminate\Database\Eloquent\Model;

class FixtureScore extends Model
{
    protected $casts = [
        'source' => ScoreSource::class,
    ];
    protected $fillable = [
        'fixture_id',
        'source',
        'first_team_score',
        'second_team_score',
        'winner_team_id',
        'is_final',
        'finalized_at',
    ];
}
