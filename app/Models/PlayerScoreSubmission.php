<?php

namespace App\Models;

use App\Enums\PlayerScoreStatus;
use Illuminate\Database\Eloquent\Model;

class PlayerScoreSubmission extends Model
{
    protected $casts = [
        'status' => PlayerScoreStatus::class,
    ];
    protected $fillable = [
        'fixture_id',
        'submitted_by',
        'first_team_score',
        'second_team_score',
        'status', // untuk tennis nomor set
        'submitted_at',

    ];
}
