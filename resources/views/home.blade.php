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

    // Phrases the intro tagline types and erases in turn (placeholders until you pick your own)
    $taglinePhrases = [
        'I build web apps people actually enjoy using.',
        'I turn messy requirements into clean Laravel code.',
        'I build this with the help of AI tools, but I\'m still the one in charge.',
    ];
@endphp

<x-layouts.app title="Your Name | Portfolio">
    <div class="mx-auto min-h-screen max-w-screen-xl px-6 py-12 md:px-12 md:py-20 lg:px-24 lg:py-0">
        <div class="lg:flex lg:justify-between lg:gap-4">

            {{-- LEFT COLUMN: stays in place on desktop while the right side scrolls --}}
            <header class="lg:sticky lg:top-0 lg:flex lg:max-h-screen lg:w-1/2 lg:flex-col lg:justify-between lg:py-24">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl dark:text-slate-100">
                        Arnold Pasco
                    </h1>
                    <h2 class="mt-3 text-md font-light tracking-tight text-slate-800 sm:text-xl dark:text-slate-200">
                        Systems Analyst | Web Developer | IT Support
                    </h2>

                    {{-- Typing tagline (Phase 3A): types and erases the phrases above --}}
                    <x-typing-tagline :phrases="$taglinePhrases" />

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

            {{-- RIGHT COLUMN: one block per section --}}
            <main class="pt-24 lg:w-1/2 lg:py-24">
                <x-page-section id="about" title="About">
                    @include('sections.about')
                </x-page-section>

                <x-page-section id="experience" title="Experience">
                    @include('sections.experience')
                </x-page-section>

                <x-page-section id="skills" title="Skills">
                    @include('sections.skills')
                </x-page-section>

                <x-page-section id="projects" title="Projects">
                    @include('sections.projects')
                </x-page-section>

                <x-page-section id="contact" title="Contact">
                    @include('sections.contact')
                </x-page-section>
            </main>

        </div>
    </div>
</x-layouts.app>