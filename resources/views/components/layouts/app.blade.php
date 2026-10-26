{{-- Base layout: wraps every page with the <head>, dark mode setup, and the theme toggle --}}
@props(['title' => null, 'description' => 'Personal portfolio website.'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description }}">

    {{-- Runs BEFORE the page paints so the wrong theme never flashes.
         Order of choice: saved choice first, then the visitor's system preference. --}}
    <script>
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark' || (savedTheme === null && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-slate-700 antialiased dark:bg-slate-900 dark:text-slate-400">
    {{-- Toggle stays in the top-right corner while scrolling --}}
    <div class="fixed right-4 top-4 z-50">
        <x-theme-toggle />
    </div>

    {{ $slot }}
</body>
</html>