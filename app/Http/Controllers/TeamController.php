<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Game;
use App\Models\User;
use App\Http\Requests\InvitationRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\TeamInvitation;
use App\Mail\TeamInviteMail;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $games = Game::all();
        $teams = Team::all();
        $query = Team::with(['game', 'captain', 'users']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('game_id')) {
            $query->where('game_id', $request->game_id);
        }
        $teams = $query->get();
        return view('equipe.index', compact('games', 'teams'));
    }

    public function create()
    {
        $games = Game::all();
        return view('equipe.create', compact('games'));
    }
    public function store(StoreTeamRequest $request)
    {
        $user = auth()->user();

        if ($user->teams()->wherePivot('is_member', true)->exists()) {
            return redirect()->route('teams.index')->with('error', 'You are already in a team');
        }

        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'game_id' => $request->game_id,
            'captain_id' => auth()->id(),
        ]);

        $team->users()->attach(auth()->id());


        return redirect()
            ->route('teams.show', $team)
            ->with('success', 'Team created successfully');
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
        $exists = TeamInvitation::where('team_id', $team->id)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            return back()->with('error', 'User already invited');
        }

        $invitation = TeamInvitation::create([
            'team_id' => $team->id,
            'email' => $request->email,
            'token' => Str::random(40)
        ]);

        Mail::to($request->email)
            ->send(new TeamInviteMail($invitation));

        return back()->with('success', 'Invitation sent successfully');
    }
    public function showInvitation($token)
    {
        $invitation = TeamInvitation::where('token', $token)
            ->with('team')
            ->firstOrFail();

        return view('invitation', compact('invitation'));
    }
    public function accept($token)
    {
        $invitation = TeamInvitation::where('token', $token)->firstOrFail();

        $user = auth()->user();

        if ($user->teams()->wherePivot('is_member', true)->exists()) {
            return redirect()
                ->route('teams.index')
                ->with('error', 'You are already in a team');
        }

        $invitation->team->users()->attach($user->id);

        $invitation->delete();

        return redirect()
            ->route('teams.show', $invitation->team)
            ->with('success', 'Team joined successfully');
    }

    public function removeMember(Team $team, User $user)
    {
        $team->users()->detach($user->id);
        return back()->with('success', 'Member removed successfully');;
    }

    public function join(Team $team)
    {
        $user = auth()->user();

        if ($user->teams()->wherePivot('is_member', true)->exists()) {
            return back()->with('error', 'You are already in a team');
        }
        $team->users()->attach($user->id, [
            'is_member' => false
        ]);

        return back()->with('success', 'Request sent to captain');
    }

    public function acceptMember(Team $team, User $user)
    {
        $team->users()->updateExistingPivot($user->id, [
            'is_member' => true
        ]);

        return back()->with('success', 'Member accepted');
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

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team deleted successfully');
    }
}
