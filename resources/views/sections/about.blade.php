{{-- About section content: the first two paragraphs always show, the rest slide open with "Read more" --}}
@php
    // Split the bio so the first two paragraphs are visible and any others are tucked away
    $visibleParagraphs = array_slice($siteSetting->bio_paragraphs, 0, 2);
    $hiddenParagraphs = array_slice($siteSetting->bio_paragraphs, 2);
@endphp

@foreach ($visibleParagraphs as $visibleParagraph)
    <p>{{ $visibleParagraph }}</p>
@endforeach

{{-- With no extra paragraphs there is nothing to expand, so the button is left out --}}
@if (count($hiddenParagraphs) > 0)
    {{-- x-data: isExpanded starts false, so the extra paragraphs stay hidden --}}
    <div x-data="{ isExpanded: false }">
        {{-- x-show + x-collapse: the extra text slides open and closed.
             It stays in the page HTML while hidden, so search engines can still read it --}}
        <div x-show="isExpanded" x-collapse class="space-y-4">
            @foreach ($hiddenParagraphs as $hiddenParagraph)
                <p @class(['pt-4' => $loop->first])>{{ $hiddenParagraph }}</p>
            @endforeach
        </div>

        <button
            type="button"
            @click="isExpanded = !isExpanded"
            :aria-expanded="isExpanded"
            class="group mt-4 inline-flex items-center gap-2 text-sm font-medium text-slate-900 dark:text-slate-200"
        >
            {{-- x-text swaps the label depending on the state --}}
            <span x-text="isExpanded ? 'Read less' : 'Read more'"></span>
            <span
                class="transition-transform duration-300 group-hover:translate-y-0.5"
                :class="isExpanded ? 'rotate-180' : ''"
                aria-hidden="true"
            >&darr;</span>
        </button>
    </div>
@endif