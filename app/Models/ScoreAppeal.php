<?php

namespace App\Models;

use App\Enums\AppealStatus;
use Illuminate\Database\Eloquent\Model;

class ScoreAppeal extends Model
{
    protected $casts = [
        'status' => AppealStatus::class,
    ];
    protected $fillable = [
        'fixture_id',
        'raised_by',
        'against_submission_id',
        'reason', // untuk tennis nomor set
        'status',
        'resolution',
        'resolved_by',
        'resolved_at',
    ];
}
