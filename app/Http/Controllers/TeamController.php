<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Game;
use App\Models\User;
use App\Http\Requests\InvitationRequest;
use Illuminate\Support\Str;
use Mail;
use App\Models\TeamInvitation;
use App\Mail\TeamInviteMail;
use App\Http\Requests\UpdateTeamRequest;

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
            'captain_id' => auth()->id(),
        ]);

        $team->users()->attach(auth()->id());

        return redirect()->route('teams.index');
    }
    public function show(Team $team)
    {
        $team->load(['users', 'captain']);
        $teams = Team::all();
        $games = Game::all();
        return view('equipe.show', compact('teams', 'games', 'team'));
    }

    public function edit(Team $team)
    {
        $games = Game::all();
        return view('equipe.edit', compact('team', 'games'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->validated());

        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Team updated successfully');
    }

    public function invite(InvitationRequest $request, Team $team)
    {
        if ($team->captain_id !== auth()->id()) {
            return back()->with('error', 'Only captain can invite');
        }

        $invitation = TeamInvitation::create([
            'team_id' => $team->id,
            'email' => $request->email,
            'token' => Str::random(40)
        ]);

        Mail::to($request->email)
            ->send(new TeamInviteMail($invitation));

        return back()->with('success', 'Invitation envoyée');
    }

    public function accept($token)
    {
        $invitation = TeamInvitation::where('token', $token)->firstOrFail();

        $user = auth()->user();

        $invitation->team->users()->attach($user->id);

        $invitation->delete();

        return redirect()
            ->route('teams.show', $invitation->team)
            ->with('success', 'Team joined successfully');
    }

    public function removeMember(Team $team, User $user)
    {
        $team->users()->detach($user->id);
        return back();
    }

    public function join(Team $team)
    {
        $user = auth()->user();

        $team->users()->attach($user->id, [
            'is_member' => false
        ]);

        return redirect()->route('teams.show', $team)->with('success', 'Request sent to captain');
    }

    public function acceptMember(Team $team, User $user)
    {
        if (auth()->id() !== $team->captain_id) {
            abort(403, 'Unauthorized');
        }
        $team->users()->updateExistingPivot($user->id, [
            'is_member' => true
        ]);

        return back();
    }
    public function leave(Team $team)
    {
        $user = auth()->user();

        $team->users()->detach($user->id);

        return back()->with('success', 'You left the team');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }
}
