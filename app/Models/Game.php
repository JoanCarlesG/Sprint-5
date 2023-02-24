<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'player1_id',
        'player2_id',
        'player1_throw1',
        'player1_throw2',
        'player2_throw1',
        'player2_throw2',
        'win'
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }
}
