<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public function teams()
    {
        return $this->belongsToMany(Team::class)->withTimestamps()->withPivot('joined_at', 'left_at');
    }
    public function matches()
    {
        return $this->hasMany(TournamentMatch::class);
    }
}
