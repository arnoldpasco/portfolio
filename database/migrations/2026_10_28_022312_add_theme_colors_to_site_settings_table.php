<?php

// Adds a nullable theme_colors column to site_settings so the palette can be edited from the admin.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Shape: {"light": {"accent": "#0d9488", ...}, "dark": {...}}; null means "use the CSS defaults"
            $table->json('theme_colors')->nullable()->after('resume_path');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('theme_colors');
        });
    }
};
