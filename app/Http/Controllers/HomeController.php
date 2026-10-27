<?php

// Loads the portfolio content from the database and shows the single home page.

namespace App\Http\Controllers;

use App\Models\ExperienceEntry;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'experienceEntries' => ExperienceEntry::orderBy('sort_order')->get(),
            // Grouped by heading; groups appear in the order of their first skill
            'skillGroups' => Skill::orderBy('sort_order')->get()->groupBy('group_name'),
            'projects' => Project::orderBy('sort_order')->get(),
        ]);
    }
}
