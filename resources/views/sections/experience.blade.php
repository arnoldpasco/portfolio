{{-- Experience section content: a list of jobs. Hovering one row dims the others (desktop) --}}

{{-- group/list lets the rows react when the whole list is hovered (see experience-item) --}}
<ul class="group/list" aria-label="Work experience">
    @foreach ($experienceEntries as $experienceEntry)
        <x-experience-item
            :dates="$experienceEntry->date_range_label"
            :job-title="$experienceEntry->job_title"
            :company="$experienceEntry->company"
            :summary="$experienceEntry->summary"
            :tags="$experienceEntry->tech_tags ?? []"
            :details="$experienceEntry->details ?? []"
        />
    @endforeach
</ul>