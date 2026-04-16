<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'name',
        'game_id',
        'max_teams',
        'cashprize',
        'date',
        'description',
        'organizer_id'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function teams()
    {
        return $this->belongsToMany(
            Team::class,
            'tournament_team',
            'tournament_id',
            'team_id',
            'captain_id'
        )->withPivot(['joined_at', 'left_at']);
    }






    public function matches()
    {
        return $this->hasMany(TournamentMatch::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
