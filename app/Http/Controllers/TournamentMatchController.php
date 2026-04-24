<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentMatch;
use Illuminate\Http\Request;
use App\Models\Announcement;

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

        Announcement::create([
            'tournament_id' => $tournament->id,
            'user_id'       => auth()->id(),
            'text'          => "Le tournoi \"{$tournament->name}\" vient de commencer !",
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

        $winnerId = null;

        if ($request->score1 > $request->score2) {
            $winnerId = $match->team1_id;
        } elseif ($request->score2 > $request->score1) {
            $winnerId = $match->team2_id;
        } else {
            return back()->with('error', 'Draw not allowed');
        }

        $match->update([
            'score1' => $request->score1,
            'score2' => $request->score2,
            'winner_id' => $winnerId,
        ]);

        $this->advanceWinner($match);

        return back()->with('success', 'Score saved');
    }
    private function advanceWinner(TournamentMatch $match)
    {
        $tournament = $match->tournament;

        $currentRound = $match->round;

        $matches = TournamentMatch::where('tournament_id', $tournament->id)
            ->where('round', $currentRound)
            ->get();

        if ($matches->whereNull('winner_id')->count() > 0) {
            return;
        }

        $winners = $matches->pluck('winner_id')->toArray();

        if ($matches->count() == 1) {

            $finalWinner = $matches->first()->winner_id;
 
            $tournament->update([
                'winner_id' => $finalWinner,
                'status' => 'finished'
            ]);
            Announcement::create([
                'tournament_id' => $tournament->id,
                'user_id'       => auth()->id(),
                'text'          => "Tournoi \"{$tournament->name}\" terminé ! L'équipe \"{$tournament->winner->name}\" a gagné 🏆",
            ]);

            return;
        }

        $nextRound = $currentRound + 1;

        for ($i = 0; $i < count($winners); $i += 2) {

            if (!isset($winners[$i + 1])) break;

            TournamentMatch::create([
                'tournament_id' => $tournament->id,
                'team1_id' => $winners[$i],
                'team2_id' => $winners[$i + 1],
                'round' => $nextRound
            ]);
        }
    }
}
