<?php

// One job in the Experience section; builds the "2022 — 2024" date label from two years.

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ExperienceEntry extends Model
{
    protected $fillable = [
        'job_title',
        'company',
        'start_year',
        'end_year',
        'summary',
        'tech_tags',
        'details',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'tech_tags' => 'array',
            'details' => 'array',
        ];
    }

    // Used in Blade as $entry->date_range_label; a missing end year means the job is current
    protected function dateRangeLabel(): Attribute
    {
        return Attribute::get(
            fn () => $this->start_year." \u{2014} ".($this->end_year ?? 'Present')
        );
    }
}
