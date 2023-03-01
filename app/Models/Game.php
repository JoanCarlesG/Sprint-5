<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'throw1',
        'throw2',
        'win'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
