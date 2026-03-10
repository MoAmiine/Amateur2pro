<?php
namespace App\Http\Controllers;

use App\Models\Team; // Hada ghadi n-créiwah mn b3d
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return view('equipe.index');
    }

    public function create()
{
    return view('equipe.create');
}
}