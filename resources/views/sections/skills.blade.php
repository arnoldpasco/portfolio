{{-- Skills section content: skills grouped under small headings --}}

<div class="space-y-8">
    @foreach ($skillGroups as $groupName => $groupSkills)
        <div>
            <h3 class="mb-3 text-sm font-semibold text-(color:--heading-color)">
                {{ $groupName }}
            </h3>

            <ul class="flex flex-wrap gap-2" aria-label="{{ $groupName }} skills">
                @foreach ($groupSkills as $skill)
                    <x-tag-chip>{{ $skill->name }}</x-tag-chip>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>