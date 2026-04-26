<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $users = User::with('role', 'Utilisateur')->get();
        return view('admin.users', compact('users'));
    }

    public function suspendUser(User $user)
    {
        $user->update(['suspended' => !$user->suspended]);
        return back()->with('success', 'Statut utilisateur mis à jour.');
    }


}
