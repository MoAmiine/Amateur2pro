<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tournament;
use App\Models\Team;
use App\Models\Announcement;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers'         => User::count(),
            'totalTournois'      => Tournament::count(),
            'totalEquipes'       => Team::count(),
            'totalAnnouncements' => Announcement::count(),
            'recentUsers'        => User::latest()->take(5)->get(),
            'recentTournois'     => Tournament::with('game')->latest()->take(5)->get(),
        ]);
    }

    public function users()
    {
        $users = User::with('role')->get();
        return view('admin.users', compact('users'));
    }

    public function suspendUser(User $user)
    {
        $user->update(['suspended' => !$user->suspended]);
        return back()->with('success', 'Statut utilisateur mis à jour.');
    }

    public function tournois()
    {
        $tournois = Tournament::with(['organizer', 'game'])->latest()->paginate(15);
        return view('admin.tournois', compact('tournois'));
    }
    public function destroyTournoi(Tournament $tournament)
    {
        $tournament->delete();
        return back()->with('success', 'Tournoi supprimé.');
    }
    public function equipes()
    {
        $equipes = Team::with(['captain', 'game'])->latest()->paginate(15);
        return view('admin.equipes', compact('equipes'));
    }
    public function destroyEquipe(Team $team)
    {
        $team->delete();
        return back()->with('success', 'Équipe supprimée.');
    }
}
