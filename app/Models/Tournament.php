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
        return $this->belongsToMany(Team::class);
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
