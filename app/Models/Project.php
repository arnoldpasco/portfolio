<?php

// One project in the hidden Projects list; links are optional.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'details',
        'tech_tags',
        'live_url',
        'github_url',
        'image_path',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'details' => 'array',
            'tech_tags' => 'array',
            'is_featured' => 'boolean',
        ];
    }
}
