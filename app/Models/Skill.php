<?php

// One skill chip; skills sharing a group_name are shown together under one heading.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'group_name',
        'description',
        'sort_order',
    ];
}
