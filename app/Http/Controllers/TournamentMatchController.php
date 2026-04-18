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
            return back()->with('error', 'Not enough teams');
        }

        $teams = $tournament->teams()->get()->shuffle();

        for ($i = 0; $i < $teams->count(); $i += 2) {

            if (!isset($teams[$i + 1])) {
                break;
            }

            TournamentMatch::create([
                'tournament_id' => $tournament->id,
                'team1_id' => $teams[$i]->id,
                'team2_id' => $teams[$i + 1]->id,
                'round' => 1
            ]);
        }

        $tournament->update([
            'status' => 'live'
        ]);

        return redirect()
            ->route('tournaments.brackets', $tournament)
            ->with('success', 'Tournament started');
    }

    public function brackets(Tournament $tournament)
    {
        $tournament->load(['matches.team1', 'matches.team2', 'matches.winner']);

        $matchesByRound = $tournament->matches
            ->sortBy('round')
            ->groupBy('round');

        return view('tournoi.brackets', compact('tournament', 'matchesByRound'));
    }
    public function score(Request $request, TournamentMatch $match)
    {
        $request->validate([
            'score1' => 'required|integer|min:0',
            'score2' => 'required|integer|min:0',
        ]);

        // winner logic
        $winner = null;

        if ($request->score1 > $request->score2) {
            $winner = $match->team1_id;
        } elseif ($request->score2 > $request->score1) {
            $winner = $match->team2_id;
        } else {
            return back()->with('error', 'Draw not allowed');
        }

        $match->update([
            'score1' => $request->score1,
            'score2' => $request->score2,
            'winner_id' => $winner
        ]);

        $this->advanceWinner($match);

        return back()->with('success', 'Score saved');
    }
    private function advanceWinner(TournamentMatch $match)
    {
        $tournament = $match->tournament;

        $nextRound = $match->round + 1;

        $nextMatch = TournamentMatch::where('tournament_id', $tournament->id)
            ->where('round', $nextRound)
            ->whereNull('team2_id')
            ->first();

        if ($nextMatch) {

            $nextMatch->update([
                'team2_id' => $match->winner_id
            ]);
        } else {

            $firstEmpty = TournamentMatch::create([
                'tournament_id' => $tournament->id,
                'team1_id' => $match->winner_id,
                'team2_id' => null,
                'round' => $nextRound
            ]);
        }
    }
}
