<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTournamentRequest;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\HttpCache\Store;
use App\Models\Tournament;

class TournamentController extends Controller
{
    public function index()
    {
        $tournament = Tournament::all();
        return view('tournoi.index', compact('tournament'));
    }

    public function create()
    {
        $games = Game::all();
        return view('tournoi.create', compact('games'));
    }

    public function store(StoreTournamentRequest $request)
    {
        Tournament::create([
            'name' => $request->name,
            'game_id' => $request->game_id,
            'max_teams' => $request->max_teams,
            'cashprize' => $request->cashprize,
            'date' => $request->date,
            'description' => $request->description,
            'organizer_id' => auth()->id(),
        ]);

        return redirect()
            ->route('tournois')
            ->with('success', 'Tournament created successfully');
    }
    public function show(Tournament $tournament, Team $team)
    {
        $team = auth()->user()?->teams()->first();
        if ($team) {
            $registered = $tournament->teams()->where('team_id', $team->id)->exists();
            $isCaptain = $team->captain_id === auth()->id();
        }
        $isFull = $tournament->teams()->count() >= $tournament->max_teams;

        return view('tournoi.show', compact(
            'tournament',
            'team',
            'registered',
            'isCaptain',
            'isFull'
        ));
    }

    public function edit(Tournament $tournament)
    {
        $games = Game::all();

        return view('tournoi.edit', compact('tournament', 'games'));
    }

    public function update(StoreTournamentRequest $request, Tournament $tournament)
    {
        $tournament->update($request->validated());

        return redirect()
            ->route('tournois.show', $tournament)
            ->with('success', 'Tournament updated successfully');
    }

    public function register(Tournament $tournament)
    {
        $team = auth()->user()->teams()->first();

        if (!$team) {
            return back()->with('error', 'You must have a team first');
        }

        if ($team->captain_id !== auth()->id()) {
            return back()->with('error', 'Only captain can register team');
        }

        if ($tournament->teams()->where('team_id', $team->id)->exists()) {
            return back()->with('error', 'Team already registered');
        }

        if ($tournament->teams()->count() >= $tournament->max_teams) {
            return back()->with('error', 'Tournament is full');
        }

        $tournament->teams()->attach($team->id, [
            'joined_at' => now()
        ]);

        return back()->with('success', 'Team registered successfully');
    }
}
