<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class)->withTimestamps()->withPivot('joined_at', 'left_at');
    }
}
