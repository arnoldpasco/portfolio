{{-- One section of the right column. On mobile it shows a sticky heading; on desktop the nav does that job --}}
@props(['id', 'title'])

{{-- scroll-mt keeps the heading from hiding under the top edge after a nav click.
     data-reveal marks this section for the fade/slide-up on scroll (see resources/js/scroll-reveal.js).
     The sticky heading's background is the page background at 80% so content blurs softly behind it --}}
<section id="{{ $id }}" aria-label="{{ $title }}" data-reveal class="mb-24 scroll-mt-16 lg:mb-36 lg:scroll-mt-24">
    <h2 class="sticky top-0 z-20 -mx-6 mb-4 bg-[color-mix(in_srgb,var(--page-background)_80%,transparent)] px-6 py-5 text-sm font-bold uppercase tracking-widest text-(color:--heading-color) backdrop-blur md:-mx-12 md:px-12 lg:hidden">
        {{ $title }}
    </h2>

    <div class="space-y-4">
        {{ $slot }}
    </div>
</section>