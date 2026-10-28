{{-- A labelled form field: a text input, or a textarea when type="textarea". Shows a server error under the field.
     Must sit inside an Alpine scope that has an `errors` object (the contact form provides it) --}}
@props(['name', 'label', 'type' => 'text'])

@php
    // One set of classes for every field, so all inputs look the same in light and dark mode
    $fieldClasses = 'mt-2 block w-full rounded-md border border-(color:--border-color) bg-transparent px-3 py-2 text-sm text-(color:--heading-color) placeholder:text-(color:--muted-color) transition focus:border-(color:--heading-color) focus:outline-none focus:ring-1 focus:ring-(color:--heading-color)';
@endphp

<div>
    <label for="{{ $name }}" class="text-sm font-medium text-(color:--heading-color)">
        {{ $label }}
    </label>

    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="5" required {{ $attributes->merge(['class' => $fieldClasses]) }}></textarea>
    @else
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" required {{ $attributes->merge(['class' => $fieldClasses]) }}>
    @endif

    {{-- x-show: only visible when the server sent an error for this field; x-text fills in its first message.
         Error text stays red in every palette on purpose, so it always reads as an error --}}
    <p x-show="errors.{{ $name }}" x-text="errors.{{ $name }}?.[0]" x-cloak class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
</div>