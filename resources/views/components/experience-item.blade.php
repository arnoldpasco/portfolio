{{-- One job in the experience list: dates, title, summary, tags, and details that slide open on click --}}
@props([
    'dates',
    'jobTitle',
    'company',
    'summary',
    'tags' => [],
    'details' => [],
])

{{-- x-data: this row's own Alpine state. isOpen starts false, so details are hidden.
     group/item lets child elements react when THIS row is hovered.
     The two opacity classes make the other rows dim while the list is hovered (desktop only);
     the trailing "!" makes the hovered row always win and stay fully visible --}}
<li
    x-data="{ isOpen: false }"
    class="group/item relative mb-12 transition-opacity duration-300 lg:group-hover/list:opacity-50 lg:hover:opacity-100!"
>
    {{-- Soft highlight box that fades in behind the row on hover (desktop only, decorative) --}}
    <div
        aria-hidden="true"
        class="absolute -inset-x-4 -inset-y-4 hidden rounded-md bg-(color:--surface-color) opacity-0 transition duration-300 motion-reduce:transition-none lg:-inset-x-6 lg:block lg:group-hover/item:opacity-60"
    ></div>

    <div class="relative sm:grid sm:grid-cols-8 sm:gap-8 md:gap-4">
        <p class="mb-2 mt-1 text-xs font-semibold uppercase tracking-wide text-(color:--muted-color) sm:col-span-2">
            {{ $dates }}
        </p>

        <div class="sm:col-span-6">
            {{-- @click flips isOpen. :aria-expanded tells screen readers whether the details are showing --}}
            <button
                type="button"
                @click="isOpen = !isOpen"
                :aria-expanded="isOpen"
                class="block w-full text-left"
            >
                <span class="flex items-start justify-between gap-4">
                    {{-- Title takes the accent color while the row is hovered (desktop only) --}}
                    <span class="font-medium leading-snug text-(color:--heading-color) transition-colors duration-300 motion-reduce:transition-none lg:group-hover/item:text-(color:--accent-color)">
                        {{ $jobTitle }} &middot; {{ $company }}
                    </span>

                    {{-- Arrow turns upside down while the row is open (:class adds rotate-180 when isOpen).
                         While closed, it nudges down a little when the row is hovered, as a hint that it opens --}}
                    <svg
                        class="mt-1 size-4 shrink-0 text-(color:--muted-color) transition-transform duration-300 motion-reduce:transition-none"
                        :class="isOpen ? 'rotate-180' : 'lg:group-hover/item:translate-y-0.5'"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>

                <span class="mt-2 block text-sm leading-normal">
                    {{ $summary }}
                </span>
            </button>

            {{-- x-show: visible only while isOpen is true. x-collapse: slides open instead of popping --}}
            <div x-show="isOpen" x-collapse>
                <ul class="mt-3 list-disc space-y-1 pl-5 text-sm leading-normal">
                    @foreach ($details as $detailText)
                        <li>{{ $detailText }}</li>
                    @endforeach
                </ul>
            </div>

            <ul class="mt-3 flex flex-wrap gap-2" aria-label="Technologies used">
                @foreach ($tags as $tagName)
                    <x-tag-chip>{{ $tagName }}</x-tag-chip>
                @endforeach
            </ul>
        </div>
    </div>
</li>