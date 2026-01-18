<?php

namespace App\Models;

use App\MatchCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
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

    /**
     * Player bisa ada di banyak team_event
     * (sebagai first atau second player)
     */
    public function teamEvents()
    {
        return $this->hasMany(TeamEvent::class, 'first_player_id')
            ->orWhere('second_player_id', $this->id);
    }
}
