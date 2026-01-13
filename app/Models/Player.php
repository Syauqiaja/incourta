<?php

namespace App\Models;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
