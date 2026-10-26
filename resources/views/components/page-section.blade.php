{{-- One section of the right column. On mobile it shows a sticky heading; on desktop the nav does that job --}}
@props(['id', 'title'])

{{-- scroll-mt keeps the heading from hiding under the top edge after a nav click --}}
<section id="{{ $id }}" aria-label="{{ $title }}" class="mb-24 scroll-mt-16 lg:mb-36 lg:scroll-mt-24">
    <h2 class="sticky top-0 z-20 -mx-6 mb-4 bg-white/80 px-6 py-5 text-sm font-bold uppercase tracking-widest text-slate-900 backdrop-blur md:-mx-12 md:px-12 lg:hidden dark:bg-slate-900/80 dark:text-slate-200">
        {{ $title }}
    </h2>

    <div class="space-y-4">
        {{ $slot }}
    </div>
</section>