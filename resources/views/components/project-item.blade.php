{{-- One project in the list: thumbnail, title, summary, tags, links, and details that slide open on click --}}
@props([
    'title',
    'summary',
    'tags' => [],
    'details' => [],
    'liveUrl' => null,
    'githubUrl' => null,
    'image' => null,
])

{{-- x-data: this project's own Alpine state. isOpen starts false, so details are hidden.
     group/item + the opacity classes give the same hover-dim effect as the experience list --}}
<li
    x-data="{ isOpen: false }"
    class="group/item relative mb-12 transition-opacity duration-300 lg:group-hover/list:opacity-50 lg:hover:opacity-100!"
>
    {{-- Soft highlight box that fades in behind the row on hover (desktop only, decorative) --}}
    <div
        aria-hidden="true"
        class="absolute -inset-x-4 -inset-y-4 hidden rounded-md transition duration-300 motion-reduce:transition-none lg:-inset-x-6 lg:block lg:group-hover/item:bg-slate-100/70 dark:lg:group-hover/item:bg-slate-800/50"
    ></div>

    <div class="relative sm:grid sm:grid-cols-8 sm:gap-8 md:gap-4">
        {{-- Thumbnail: a real screenshot when $image is given, otherwise a placeholder box.
             Real images are lazy-loaded and have a width/height so the page does not jump while they load --}}
        <div class="mb-4 sm:order-1 sm:col-span-2 sm:mb-0 sm:mt-1">
            @if ($image)
                <img
                    src="{{ asset($image) }}"
                    alt="Screenshot of {{ $title }}"
                    width="200"
                    height="125"
                    loading="lazy"
                    class="aspect-video w-full rounded border-2 border-slate-300/60 object-cover dark:border-slate-700"
                >
            @else
                <div
                    aria-hidden="true"
                    class="flex aspect-video w-full items-center justify-center rounded border-2 border-slate-300/60 bg-gradient-to-br from-slate-200 to-slate-100 text-xs font-medium text-slate-500 dark:border-slate-700 dark:from-slate-800 dark:to-slate-900"
                >
                    Screenshot
                </div>
            @endif
        </div>

        <div class="sm:order-2 sm:col-span-6">
            {{-- @click flips isOpen. :aria-expanded tells screen readers whether the details are showing --}}
            <button
                type="button"
                @click="isOpen = !isOpen"
                :aria-expanded="isOpen"
                class="block w-full text-left"
            >
                <span class="flex items-start justify-between gap-4">
                    {{-- Title takes the accent color while the project is hovered (desktop only) --}}
                    <span class="font-medium leading-snug text-slate-900 transition-colors duration-300 motion-reduce:transition-none lg:group-hover/item:text-(--accent-color) dark:text-slate-200">
                        {{ $title }}
                    </span>

                    {{-- Arrow turns upside down while the project is open.
                         While closed, it nudges down a little when the project is hovered --}}
                    <svg
                        class="mt-1 size-4 shrink-0 text-slate-500 transition-transform duration-300 motion-reduce:transition-none"
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
                <div class="mt-3 space-y-3 text-sm leading-normal">
                    @foreach ($details as $detailParagraph)
                        <p>{{ $detailParagraph }}</p>
                    @endforeach
                </div>
            </div>

            {{-- Links sit OUTSIDE the toggle button (a link inside a button is invalid HTML).
                 A link is only drawn when its URL is filled in.
                 The text span gets a sliding underline (.link-underline in app.css); the arrow nudges up and right --}}
            @if ($liveUrl || $githubUrl)
                <ul class="mt-4 flex flex-wrap gap-x-5 gap-y-2 text-sm font-medium" aria-label="Project links">
                    @if ($liveUrl)
                        <li>
                            <a
                                href="{{ $liveUrl }}"
                                target="_blank"
                                rel="noreferrer noopener"
                                class="group/link inline-flex items-center gap-1 text-slate-900 transition-colors hover:text-(--accent-color) focus-visible:text-(--accent-color) dark:text-slate-200"
                            >
                                <span class="link-underline">Live site</span>
                                <span class="transition-transform group-hover/link:-translate-y-0.5 group-hover/link:translate-x-0.5" aria-hidden="true">&#8599;</span>
                            </a>
                        </li>
                    @endif

                    @if ($githubUrl)
                        <li>
                            <a
                                href="{{ $githubUrl }}"
                                target="_blank"
                                rel="noreferrer noopener"
                                class="group/link inline-flex items-center gap-1 text-slate-900 transition-colors hover:text-(--accent-color) focus-visible:text-(--accent-color) dark:text-slate-200"
                            >
                                <span class="link-underline">GitHub</span>
                                <span class="transition-transform group-hover/link:-translate-y-0.5 group-hover/link:translate-x-0.5" aria-hidden="true">&#8599;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            @endif

            <ul class="mt-4 flex flex-wrap gap-2" aria-label="Technologies used">
                @foreach ($tags as $tagName)
                    <x-tag-chip>{{ $tagName }}</x-tag-chip>
                @endforeach
            </ul>
        </div>
    </div>
</li>