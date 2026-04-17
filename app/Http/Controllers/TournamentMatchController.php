<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentMatch;
use Illuminate\Http\Request;

class TournamentMatchController extends Controller
{
public function start(Tournament $tournament)
{
    if ($tournament->teams()->count() < 2) {
        return back()->with('error', 'Not enough teams to start tournament');
    }

    $tournament->update([
        'status' => 'live'
    ]);

    return redirect()
        ->route('tournaments.brackets', $tournament)
        ->with('success', 'Tournament started successfully!');
}

    public function brackets(Tournament $tournament)
    {
        $tournament->load(['matches.team1', 'matches.team2', 'matches.winner']);

        $matchesByRound = $tournament->matches
            ->sortBy('round')
            ->groupBy('round');

        return view('tournoi.brackets', compact('tournament', 'matchesByRound'));
    }
}
