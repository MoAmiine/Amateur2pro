<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTournamentRequest;
use Illuminate\Support\Facades\Auth;


class TournamentController extends Controller
{
    public function index()
    {
        return view('tournoi.index'); 
    }

    public function create(){
        $games = Game::all();
        return view('tournoi.create', compact('games'));
    }

    public function store(StoreTournamentRequest $request){
        $validated = $request->validated();
        Auth::user()->tournament()->create($validated);

        return redirect()->route('tournois');
    }
}