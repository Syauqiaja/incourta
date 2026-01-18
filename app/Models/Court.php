<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    // lokasi tempat pertandingan berlangsung
    protected $fillable = [
        "name",
        "location",
        "is_active"
    ];

    public function fixtureSchedule()
    {
        return $this->hasMany(FixtureSchedule::class);
    }
}
