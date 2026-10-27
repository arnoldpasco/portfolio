{{-- Experience section content: a list of jobs. Hovering one row dims the others (desktop) --}}
{{-- TODO Phase 4: this placeholder data will come from the database instead --}}
@php
    $experienceEntries = [
        [
            'dates' => '2024 — Present',
            'jobTitle' => 'Web Developer',
            'company' => 'Company One',
            'summary' => 'Build and maintain websites and internal tools. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'tags' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'details' => [
                'Built a customer dashboard that cut manual work by hours each week.',
                'Worked with designers to turn mockups into responsive pages.',
                'Wrote tests and cleaned up older code so changes were safer to ship.',
            ],
        ],
        [
            'dates' => '2022 — 2024',
            'jobTitle' => 'Junior Developer',
            'company' => 'Company Two',
            'summary' => 'Supported the team with features and bug fixes. Ut enim ad minim veniam, quis nostrud exercitation.',
            'tags' => ['PHP', 'JavaScript', 'Git'],
            'details' => [
                'Fixed bugs reported by users and improved page loading times.',
                'Added new form pages with validation and email notifications.',
            ],
        ],
        [
            'dates' => '2021 — 2022',
            'jobTitle' => 'Freelance Developer',
            'company' => 'Self-employed',
            'summary' => 'Made small business websites for local clients. Duis aute irure dolor in reprehenderit.',
            'tags' => ['HTML', 'CSS', 'WordPress'],
            'details' => [
                'Delivered five client websites from first call to launch.',
                'Handled hosting, domains, and basic maintenance.',
            ],
        ],
    ];
@endphp

{{-- group/list lets the rows react when the whole list is hovered (see experience-item) --}}
<ul class="group/list" aria-label="Work experience">
    @foreach ($experienceEntries as $experienceEntry)
        <x-experience-item
            :dates="$experienceEntry['dates']"
            :job-title="$experienceEntry['jobTitle']"
            :company="$experienceEntry['company']"
            :summary="$experienceEntry['summary']"
            :tags="$experienceEntry['tags']"
            :details="$experienceEntry['details']"
        />
    @endforeach
</ul>