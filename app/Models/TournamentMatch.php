<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentMatch extends Model
{
    protected $fillable = [
        'tournament_id',
        'team1_id',
        'team2_id',
        'score1',
        'score2',
        'winner_id',
        'round'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function team1()
    {
        return $this->belongsTo(Team::class , 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class , 'team2_id');
    }
}
