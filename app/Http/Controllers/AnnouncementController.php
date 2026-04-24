<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with(['tournament', 'user'])
            ->latest()
            ->paginate(15);

        return view('announcement.index', compact('announcements'));
    }
}