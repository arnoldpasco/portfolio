<?php

// Creates the experience_entries table: one row per job shown in the Experience section.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experience_entries', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('company');
            $table->unsignedSmallInteger('start_year');
            // null means "still working here" and is shown as "Present"
            $table->unsignedSmallInteger('end_year')->nullable();
            $table->text('summary');
            $table->json('tech_tags')->nullable();
            $table->json('details')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experience_entries');
    }
};
