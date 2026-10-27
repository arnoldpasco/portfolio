<?php

// Fills skills with the placeholder skill groups that used to live in skills.blade.php.

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $placeholderSkillGroups = [
            'Frontend' => ['HTML', 'CSS', 'Tailwind CSS', 'JavaScript', 'Alpine.js'],
            'Backend' => ['PHP', 'Laravel', 'MySQL', 'REST APIs'],
            'Tools' => ['Git', 'GitHub', 'Composer', 'Linux'],
        ];

        // One running counter keeps groups and skills in the order written above
        $sortOrder = 0;

        foreach ($placeholderSkillGroups as $groupName => $skillNames) {
            foreach ($skillNames as $skillName) {
                Skill::create([
                    'name' => $skillName,
                    'group_name' => $groupName,
                    'sort_order' => $sortOrder++,
                ]);
            }
        }
    }
}
