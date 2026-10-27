<?php

// Fills projects with the three placeholder projects (both links, GitHub only, no links).

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $placeholderProjects = [
            [
                'title' => 'Project One',
                'summary' => 'A short, friendly sentence about what this project does and why it matters. Lorem ipsum dolor sit amet.',
                'tech_tags' => ['Laravel', 'MySQL', 'Alpine.js'],
                'details' => [
                    'Longer description of the problem this project solves and who it was built for. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                    'What I did: planned the database, built the pages, and added the contact and login features.',
                ],
                'live_url' => 'https://example.com',
                'github_url' => 'https://github.com/your-username/project-one',
                'is_featured' => true,
            ],
            [
                'title' => 'Project Two',
                'summary' => 'Another short summary. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.',
                'tech_tags' => ['PHP', 'Tailwind CSS'],
                'details' => [
                    'This one has a GitHub link but no live site, so only one button is shown.',
                ],
                'live_url' => null,
                'github_url' => 'https://github.com/your-username/project-two',
                'is_featured' => true,
            ],
            [
                'title' => 'Project Three',
                'summary' => 'A private or client project. Excepteur sint occaecat cupidatat non proident, sunt in culpa.',
                'tech_tags' => ['JavaScript', 'REST APIs'],
                'details' => [
                    'This one has no links at all, so no link buttons are shown. Add a screenshot and live link later if you can.',
                ],
                'live_url' => null,
                'github_url' => null,
                'is_featured' => false,
            ],
        ];

        foreach ($placeholderProjects as $position => $placeholderProject) {
            Project::create($placeholderProject + [
                'slug' => Str::slug($placeholderProject['title']),
                'sort_order' => $position,
            ]);
        }
    }
}
