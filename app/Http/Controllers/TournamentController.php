<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index()
    {
        return view('tournoi.index'); 
    }

    public function create(){
        return view('tournoi.create');
    }
}