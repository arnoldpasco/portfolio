<?php

// Sends the resume PDF from private storage as a download.

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResumeDownloadController extends Controller
{
    public function __invoke(): StreamedResponse
    {
        $siteSetting = SiteSetting::current();
        $resumePath = $siteSetting->resume_path;

        // Friendly message instead of a crash when no resume has been uploaded yet
        if (! $resumePath || ! Storage::exists($resumePath)) {
            abort(404, 'My resume is not available right now. Please send me a message and I will share it.');
        }

        // Download name uses the person's name, e.g. "arnold-pasco-resume.pdf"
        return Storage::download($resumePath, Str::slug($siteSetting->name).'-resume.pdf');
    }
}
