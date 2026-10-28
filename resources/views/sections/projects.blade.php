{{-- Projects section content: hidden by default; the folder button slides the list open in place --}}

{{-- x-data: areProjectsVisible starts false, so the list is hidden when the page loads --}}
<div x-data="{ areProjectsVisible: false }">
    <p>
        I've built a few things I'm proud of. They're tucked away so the page stays calm &mdash; open the folder whenever you're curious.
    </p>

    {{-- @click flips the state. aria-controls points at the list this button opens --}}
    <button
        type="button"
        @click="areProjectsVisible = !areProjectsVisible"
        :aria-expanded="areProjectsVisible"
        aria-controls="project-list"
        class="group mt-6 inline-flex items-center gap-3 rounded-md border border-(color:--border-color) px-4 py-2 text-sm font-medium text-(color:--heading-color) transition hover:bg-(color:--surface-color)"
    >
        {{-- Folder icon: closed folder when hidden, open folder when shown --}}
        <svg class="size-5 transition-transform duration-300 group-hover:-rotate-6 motion-reduce:transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
            <path x-show="!areProjectsVisible" stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            <path x-show="areProjectsVisible" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
        </svg>

        {{-- x-text swaps the label depending on the state --}}
        <span x-text="areProjectsVisible ? 'Hide my projects' : 'Show my projects'"></span>
    </button>

    {{-- x-show + x-collapse: the list slides open and closed.
         The projects stay in the page HTML while hidden, so search engines can still read them.
         x-cloak stops a flash of the list before Alpine has loaded.
         pt-10 is padding (not margin) so the slide animation stays smooth --}}
    <div id="project-list" x-show="areProjectsVisible" x-collapse x-cloak>
        <ul class="group/list pt-10" aria-label="Projects">
            @foreach ($projects as $project)
                <x-project-item
                    :title="$project->title"
                    :summary="$project->summary"
                    :tags="$project->tech_tags ?? []"
                    :details="$project->details ?? []"
                    :live-url="$project->live_url"
                    :github-url="$project->github_url"
                    :image="$project->image_path"
                />
            @endforeach
        </ul>
    </div>
</div>