<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixtureSchedule extends Model
{
    protected $fillable = [
        "fixture_id",
        "court_id",
        "scheduled_date",
        "scheduled_time",
        "started_at",
        "ended_at",
    ];
}
