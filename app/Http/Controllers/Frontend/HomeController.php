<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\SocialLink;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $skillCategories = SkillCategory::with(['skills' => function($q) {
            $q->where('is_active', true)->orderBy('sort_order');
        }])->where('is_active', true)->orderBy('sort_order')->get();

        $featuredProjects = Project::with(['category', 'technologies'])
            ->published()
            ->featured()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $experiences = Experience::orderBy('sort_order')->orderByDesc('start_date')->get();
        $educations = Education::orderBy('sort_order')->orderByDesc('start_date')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.home', compact(
            'profile',
            'skillCategories',
            'featuredProjects',
            'experiences',
            'educations',
            'socialLinks'
        ));
    }
}