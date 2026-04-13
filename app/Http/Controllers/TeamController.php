<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Game;
use App\Models\User;
use App\Http\Requests\InvitationRequest;


class TeamController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $teams = Team::all();
        return view('equipe.index', compact('games', 'teams'));
    }

    public function create()
    {
        $games = Game::all();
        return view('equipe.create', compact('games'));
    }
    public function store(StoreTeamRequest $request)
    {
        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'game_id' => $request->game_id,
            'captain_id' => auth()->id()
        ]);

        $team->users()->attach(auth()->id());

        return redirect()->route('equipes.index');
    }
    public function show(Team $team)
{
    $team->load(['users', 'captain']);
    $teams = Team::all();
    $games = Game::all();
    return view('equipe.show', compact('teams', 'games', 'team'));
}

    public function edit(){
        $team = Team::all();
        return view('equipe.edit', compact('team'));
    }

public function invite(InvitationRequest $request, Team $team)
{


    $user = User::where('email', $request->email)->first();

    if ($team->users()->where('user_id', $user->id)->exists()) {
        return back()->with('error', 'User already in team');
    }

    $team->users()->attach($user->id);

    return redirect()->route('equipes.show', $team)->with('success', 'Invitation envoyée avec succes');
}
}
