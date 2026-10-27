<?php

// Creates the projects table: one row per project in the hidden Projects list.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            // Paragraphs shown when a project row is expanded
            $table->json('details')->nullable();
            $table->json('tech_tags')->nullable();
            // Empty URLs hide their button on the page
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
