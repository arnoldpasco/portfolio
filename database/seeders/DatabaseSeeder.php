<?php

// Runs every seeder that fills the portfolio's placeholder content.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            ExperienceEntrySeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
