<?php

// Fills experience_entries with the placeholder jobs that used to live in experience.blade.php.

namespace Database\Seeders;

use App\Models\ExperienceEntry;
use Illuminate\Database\Seeder;

class ExperienceEntrySeeder extends Seeder
{
    public function run(): void
    {
        $placeholderEntries = [
            [
                'job_title' => 'Web Developer',
                'company' => 'Company One',
                'start_year' => 2024,
                'end_year' => null,
                'summary' => 'Build and maintain websites and internal tools. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'tech_tags' => ['Laravel', 'MySQL', 'Tailwind CSS'],
                'details' => [
                    'Built a customer dashboard that cut manual work by hours each week.',
                    'Worked with designers to turn mockups into responsive pages.',
                    'Wrote tests and cleaned up older code so changes were safer to ship.',
                ],
            ],
            [
                'job_title' => 'Junior Developer',
                'company' => 'Company Two',
                'start_year' => 2022,
                'end_year' => 2024,
                'summary' => 'Supported the team with features and bug fixes. Ut enim ad minim veniam, quis nostrud exercitation.',
                'tech_tags' => ['PHP', 'JavaScript', 'Git'],
                'details' => [
                    'Fixed bugs reported by users and improved page loading times.',
                    'Added new form pages with validation and email notifications.',
                ],
            ],
            [
                'job_title' => 'Freelance Developer',
                'company' => 'Self-employed',
                'start_year' => 2021,
                'end_year' => 2022,
                'summary' => 'Made small business websites for local clients. Duis aute irure dolor in reprehenderit.',
                'tech_tags' => ['HTML', 'CSS', 'WordPress'],
                'details' => [
                    'Delivered five client websites from first call to launch.',
                    'Handled hosting, domains, and basic maintenance.',
                ],
            ],
        ];

        // The array position becomes sort_order, so the newest job stays first
        foreach ($placeholderEntries as $position => $placeholderEntry) {
            ExperienceEntry::create($placeholderEntry + ['sort_order' => $position]);
        }
    }
}
