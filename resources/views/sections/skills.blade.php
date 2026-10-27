{{-- Skills section content: skills grouped under small headings --}}
{{-- TODO Phase 4: this placeholder data will come from the database instead --}}
@php
    $skillGroups = [
        'Frontend' => ['HTML', 'CSS', 'Tailwind CSS', 'JavaScript', 'Alpine.js'],
        'Backend' => ['PHP', 'Laravel', 'MySQL', 'REST APIs'],
        'Tools' => ['Git', 'GitHub', 'Composer', 'Linux'],
    ];
@endphp

<div class="space-y-8">
    @foreach ($skillGroups as $groupName => $groupSkills)
        <div>
            <h3 class="mb-3 text-sm font-semibold text-slate-900 dark:text-slate-200">
                {{ $groupName }}
            </h3>

            <ul class="flex flex-wrap gap-2" aria-label="{{ $groupName }} skills">
                @foreach ($groupSkills as $skillName)
                    <x-tag-chip>{{ $skillName }}</x-tag-chip>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>