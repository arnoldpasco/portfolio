<?php

// Public routes: the one-page portfolio, the contact form submission and the resume download.

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResumeDownloadController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/resume', ResumeDownloadController::class)->name('resume.download');

// throttle:5,1 allows 5 requests per minute per IP address
Route::post('/contact', [ContactMessageController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
