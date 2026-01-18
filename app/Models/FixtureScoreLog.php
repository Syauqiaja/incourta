<?php

namespace App\Models;

use App\Enums\ScoringType;
use Illuminate\Database\Eloquent\Model;

class FixtureScoreLog extends Model
{
    protected $casts = [
        'type' => ScoringType::class,
    ];
    protected $fillable = [
        'fixture_id',
        'type',
        'set_number', // untuk tennis nomor set
        'first_team_score',
        'second_team_score',
        'created_by',

    ];
}
