<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTournamentRequest;
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
    public function show(Tournament $tournament)
    {
        $tournament->all();

        return view('tournoi.show', compact('tournament'));
    }

    
}
