<?php

namespace App\Models;

use App\MatchCategories;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'user_id',
        'phone_number',
        'city',
        'category',
        'photo',
        'nik',
        'instagram',
        'reclub',
    ];

    protected $casts = [
        'category' => MatchCategories::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
