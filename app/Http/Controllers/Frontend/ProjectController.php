<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan import Facade ini

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProjectCategory::all();
        $query = Project::with(['category', 'technologies'])->published();

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $projects = $query->orderBy('sort_order')->paginate(6)->withQueryString();

        return view('frontend.projects.index', compact('projects', 'categories'));
    }

    public function show(string $slug)
    {
        $query = Project::with(['category', 'technologies', 'features', 'galleries'])
            ->where('slug', $slug);

        // Gunakan Facade Auth::check() agar tidak muncul warning di editor
        if (!Auth::check()) {
            $query->published();
        }

        $project = $query->firstOrFail();

        return view('frontend.projects.show', compact('project'));
    }
}
