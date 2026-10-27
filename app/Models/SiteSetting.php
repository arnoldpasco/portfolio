<?php

// The portfolio's single settings row: name, role, tagline phrases, bio and social links.

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'name',
        'role',
        'tagline_phrases',
        'bio_paragraphs',
        'github_url',
        'linkedin_url',
        'email',
        'resume_path',
    ];

    protected function casts(): array
    {
        return [
            'tagline_phrases' => 'array',
            'bio_paragraphs' => 'array',
        ];
    }

    // The site only ever has one settings row; a 404 here means the seeder has not been run yet
    public static function current(): self
    {
        return static::query()->firstOrFail();
    }

    // Used in Blade as $siteSetting->social_links: label => URL, with empty ones removed
    protected function socialLinks(): Attribute
    {
        return Attribute::get(fn () => array_filter([
            'GitHub' => $this->github_url,
            'LinkedIn' => $this->linkedin_url,
            'Email' => $this->email ? 'mailto:'.$this->email : null,
        ]));
    }
}
