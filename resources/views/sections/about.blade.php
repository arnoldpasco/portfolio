{{-- About section content: two paragraphs always visible, the rest slides open with "Read more" --}}
{{-- TODO: replace the placeholder text with your real bio --}}
<p>
    I'm a developer who loves turning ideas into clean, friendly websites. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
</p>
<p>
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.
</p>

{{-- x-data: isExpanded starts false, so the extra paragraphs stay hidden --}}
<div x-data="{ isExpanded: false }">
    {{-- x-show + x-collapse: the extra text slides open and closed.
         It stays in the page HTML while hidden, so search engines can still read it --}}
    <div x-show="isExpanded" x-collapse class="space-y-4">
        <p class="pt-4">
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
        </p>
        <p>
            Outside of work, I enjoy trying new tools, helping other beginners, and finding small details that make a page feel alive.
        </p>
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
        >↓</span>
    </button>
</div>