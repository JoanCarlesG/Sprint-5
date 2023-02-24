<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function games()
    {
        return $this->hasMany(Game::class, 'player1_id')->orWhere('player2_id', $this->id);
    }
    public function getGames()
    {
        return Game::where('player1_id', $this->id)
            ->orWhere('player2_id', $this->id)
            ->get();
    }

    public function winRate()
    {
        $totalGames = $this->getGames()->count();
        $wonGames = $this->getGames()->where('win', $this->id)->count();
        $winRate = $totalGames > 0 ? round($wonGames / $totalGames * 100) : 0;
        return $winRate;
    }

    public function toArrayWithWinRate()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'win_rate' => $this->winRate(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
