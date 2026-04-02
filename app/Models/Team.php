<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'captain_id'
    ];

    public function captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class)
            ->withPivot('joined_at', 'left_at');
    }
}
