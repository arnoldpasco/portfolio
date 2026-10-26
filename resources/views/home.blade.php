{{-- Home page: fixed left column (intro, nav, socials) + scrolling right column of sections --}}
@php
    // Section ids and the label shown in the nav, in page order
    $navigationSections = [
        'about' => 'About',
        'experience' => 'Experience',
        'skills' => 'Skills',
        'projects' => 'Projects',
        'contact' => 'Contact',
    ];
@endphp

<x-layouts.app title="Your Name | Portfolio">
    <div class="mx-auto min-h-screen max-w-screen-xl px-6 py-12 md:px-12 md:py-20 lg:px-24 lg:py-0">
        <div class="lg:flex lg:justify-between lg:gap-4">

            {{-- LEFT COLUMN: stays in place on desktop while the right side scrolls --}}
            <header class="lg:sticky lg:top-0 lg:flex lg:max-h-screen lg:w-1/2 lg:flex-col lg:justify-between lg:py-24">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl dark:text-slate-100">
                        Your Name
                    </h1>
                    <h2 class="mt-3 text-lg font-medium tracking-tight text-slate-800 sm:text-xl dark:text-slate-200">
                        Your Role Here
                    </h2>
                    {{-- Phase 3 turns this tagline into a typing effect --}}
                    <p class="mt-4 max-w-xs leading-normal">
                        One friendly line about what you build and who you build it for.
                    </p>

                    <x-section-nav :sections="$navigationSections" />

                    {{-- TODO Phase 5: point this link to the real resume download route --}}
                    <a
                        href="#"
                        class="group mt-10 inline-flex items-center gap-2 rounded-md border border-slate-400 px-4 py-2 text-sm font-medium text-slate-900 transition hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        Download Resume
                        <span class="transition-transform group-hover:translate-y-0.5" aria-hidden="true">↓</span>
                    </a>
                </div>

                <x-social-links />
            </header>

            {{-- RIGHT COLUMN: placeholder sections, replaced with real content in 2B and 2C --}}
            <main class="pt-24 lg:w-1/2 lg:py-24">
                @foreach ($navigationSections as $sectionId => $sectionTitle)
                    <x-page-section :id="$sectionId" :title="$sectionTitle">
                        <p>Placeholder text for the {{ $sectionTitle }} section. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </x-page-section>
                @endforeach
            </main>

        </div>
    </div>
</x-layouts.app>