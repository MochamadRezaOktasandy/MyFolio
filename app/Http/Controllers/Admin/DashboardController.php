<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalSkills = Skill::count();
        $totalCertificates = Certificate::count();
        $totalMessages = ContactMessage::count();
        $unreadMessagesCount = ContactMessage::where('status', 'unread')->count();

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalSkills',
            'totalCertificates',
            'totalMessages',
            'unreadMessagesCount',
            'recentMessages'
        ));
    }
}