<?php

// The portfolio's single settings row: name, role, tagline phrases, bio, social links and palette overrides.

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    // Which CSS variable each palette color controls (the same keys are used for light and dark)
    public const THEME_COLOR_VARIABLES = [
        'accent' => '--accent-color',
        'spotlight' => '--spotlight-base',
        'background' => '--page-background',
        'text' => '--page-text',
        'heading' => '--heading-color',
        'muted' => '--muted-color',
        'border' => '--border-color',
        'surface' => '--surface-color',
    ];

    // Only plain six-digit hex colors are accepted, which also blocks any CSS injection
    private const HEX_COLOR_PATTERN = '/^#[0-9a-fA-F]{6}$/';

    protected $fillable = [
        'name',
        'role',
        'tagline_phrases',
        'bio_paragraphs',
        'github_url',
        'linkedin_url',
        'email',
        'resume_path',
        'theme_colors',
    ];

    protected function casts(): array
    {
        return [
            'tagline_phrases' => 'array',
            'bio_paragraphs' => 'array',
            'theme_colors' => 'array',
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

    // Used in Blade as $siteSetting->theme_css_overrides: CSS that overrides the default palette.
    // Empty string when nothing is saved. Invalid colors are skipped, never printed.
    protected function themeCssOverrides(): Attribute
    {
        return Attribute::get(function () {
            $savedColors = $this->theme_colors ?? [];
            $selectorsByTheme = ['light' => 'html:root', 'dark' => 'html:root.dark'];
            $cssBlocks = [];

            foreach ($selectorsByTheme as $themeName => $selector) {
                $declarations = [];

                foreach (self::THEME_COLOR_VARIABLES as $colorKey => $cssVariable) {
                    $colorValue = $savedColors[$themeName][$colorKey] ?? null;

                    if (is_string($colorValue) && preg_match(self::HEX_COLOR_PATTERN, $colorValue)) {
                        $declarations[] = $cssVariable.': '.$colorValue.';';
                    }
                }

                if ($declarations !== []) {
                    $cssBlocks[] = $selector.' { '.implode(' ', $declarations).' }';
                }
            }

            return implode("\n", $cssBlocks);
        });
    }
}
