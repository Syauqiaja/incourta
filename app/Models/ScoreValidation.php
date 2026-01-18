<?php

namespace App\Models;

use App\Enums\DecisionType;
use Illuminate\Database\Eloquent\Model;

class ScoreValidation extends Model
{
    protected $casts = [
        'decision' => DecisionType::class,
    ];
    protected $fillable = [
        'fixture_id',
        'player_submission_id',
        'validated_by',
        'decision',
        'note',
        'validated_at'
    ];
}
