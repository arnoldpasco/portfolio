{{-- Home page: fixed left column (intro, nav, socials) + scrolling right column of sections --}}
@php
    // Section ids and the label shown in the nav, in page order (page structure, not editable content)
    $navigationSections = [
        'about' => 'About',
        'experience' => 'Experience',
        'skills' => 'Skills',
        'projects' => 'Projects',
        'contact' => 'Contact',
    ];
@endphp

{{-- theme-css carries the palette colors saved in the admin (empty = use the defaults in app.css) --}}
<x-layouts.app
    :title="$siteSetting->name . ' | Portfolio'"
    :theme-css="$siteSetting->theme_css_overrides"
>
    <div class="mx-auto min-h-screen max-w-screen-xl px-6 py-12 md:px-12 md:py-20 lg:px-24 lg:py-0">
        <div class="lg:flex lg:justify-between lg:gap-4">

            {{-- LEFT COLUMN: stays in place on desktop while the right side scrolls --}}
            <header class="lg:sticky lg:top-0 lg:flex lg:max-h-screen lg:w-1/2 lg:flex-col lg:justify-between lg:py-24">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight text-(color:--heading-color) sm:text-5xl">
                        {{ $siteSetting->name }}
                    </h1>
                    <h2 class="mt-3 text-md font-light tracking-tight text-(color:--heading-color) sm:text-xl">
                        {{ $siteSetting->role }}
                    </h2>

                    {{-- Typing tagline (Phase 3A): types and erases the phrases from the settings --}}
                    <x-typing-tagline :phrases="$siteSetting->tagline_phrases" />

                    <x-section-nav :sections="$navigationSections" />

                    {{-- Downloads the resume PDF from private storage (Phase 5B) --}}
                    <a
                        href="{{ route('resume.download') }}"
                        class="group mt-10 inline-flex items-center gap-2 rounded-md border border-(color:--border-color) px-4 py-2 text-sm font-medium text-(color:--heading-color) transition hover:bg-(color:--surface-color)"
                    >
                        Download Resume
                        <span class="transition-transform group-hover:translate-y-0.5" aria-hidden="true">&darr;</span>
                    </a>
                </div>

                <x-social-links :links="$siteSetting->social_links" />
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