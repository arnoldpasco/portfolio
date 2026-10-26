{{-- Left-column navigation: each link has a line that grows when its section is active --}}
@props(['sections'])

{{-- x-data: starts the scroll-spy and gives this nav an "activeSectionId" value.
     array_keys() sends the list of section ids (about, experience, ...) to the JavaScript --}}
<nav
    aria-label="In-page links"
    class="mt-16 hidden lg:block"
    x-data="scrollSpy(@js(array_keys($sections)))"
>
    <ul class="w-max">
        @foreach ($sections as $sectionId => $sectionTitle)
            <li>
                <a href="#{{ $sectionId }}" class="group flex items-center py-3">
                    {{-- The line. :class swaps its style when this section is the active one.
                         group-hover grows it when the link is hovered --}}
                    <span
                        class="mr-4 h-px transition-all duration-300 ease-out group-hover:w-16 group-hover:bg-slate-900 dark:group-hover:bg-slate-200"
                        :class="activeSectionId === '{{ $sectionId }}'
                            ? 'w-16 bg-slate-900 dark:bg-slate-200'
                            : 'w-8 bg-slate-400 dark:bg-slate-600'"
                    ></span>

                    {{-- The label gets brighter when active or hovered --}}
                    <span
                        class="text-xs font-bold uppercase tracking-widest group-hover:text-slate-900 dark:group-hover:text-slate-200"
                        :class="activeSectionId === '{{ $sectionId }}'
                            ? 'text-slate-900 dark:text-slate-200'
                            : 'text-slate-500'"
                    >
                        {{ $sectionTitle }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>