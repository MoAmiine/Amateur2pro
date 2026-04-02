<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'title',
        'organizer_id',
        'max_teams',
        'status'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class , 'organizer_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function matches()
    {
        return $this->hasMany(TournamentMatch::class);
    }
}
