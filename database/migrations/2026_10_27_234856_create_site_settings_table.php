<?php

// Creates the site_settings table: a single row holding the name, role, tagline, bio and social links.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            // Phrases the intro tagline types and erases in turn
            $table->json('tagline_phrases');
            // One entry per paragraph; the first two show always, the rest sit behind "Read more"
            $table->json('bio_paragraphs');
            // Empty social fields are left out of the social icon row
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('email')->nullable();
            // Filled in Phase 5 when the resume upload exists
            $table->string('resume_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
