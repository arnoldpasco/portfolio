<?php

// Fills site_settings with your name and role plus the placeholder tagline, bio and social links.

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'name' => 'Arnold Pasco',
            'role' => 'Systems Analyst | Web Developer | IT Support',
            'tagline_phrases' => [
                'I build web apps people actually enjoy using.',
                'I turn messy requirements into clean Laravel code.',
                'I build this with the help of AI tools, but I\'m still the one in charge.',
            ],
            'bio_paragraphs' => [
                'I\'m a developer who loves turning ideas into clean, friendly websites. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.',
                'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem.',
                'Outside of work, I enjoy trying new tools, helping other beginners, and finding small details that make a page feel alive.',
            ],
            'github_url' => 'https://github.com/your-username',
            'linkedin_url' => 'https://www.linkedin.com/in/your-username',
            'email' => 'you@example.com',
        ]);
    }
}
