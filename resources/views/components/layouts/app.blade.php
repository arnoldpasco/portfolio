{{-- Base layout: wraps every page with the <head>, dark mode setup, admin palette overrides and the theme toggle --}}
@props(['title' => null, 'description' => 'Personal portfolio website.', 'themeCss' => null])

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

    {{-- Palette colors saved in the admin. The CSS is built only from validated #RRGGBB values
         in the model, so printing it unescaped is safe. Placed after @vite so it wins over the defaults. --}}
    @if ($themeCss)
        <style>{!! $themeCss !!}</style>
    @endif
</head>

{{-- Colors come from CSS variables (see app.css) so the admin can change them --}}
<body class="bg-(color:--page-background) text-(color:--page-text) antialiased">
    {{-- Toggle stays in the top-right corner while scrolling --}}
    <div class="fixed right-4 top-4 z-50">
        <x-theme-toggle />
    </div>

    {{ $slot }}
</body>
</html>