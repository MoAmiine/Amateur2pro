<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with(['tournament', 'user'])
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact('announcements'));
    }
}