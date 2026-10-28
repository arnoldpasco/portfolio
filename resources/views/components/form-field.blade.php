{{-- A labelled form field: a text input, or a textarea when type="textarea". Shows a server error under the field.
     Must sit inside an Alpine scope that has an `errors` object (the contact form provides it) --}}
@props(['name', 'label', 'type' => 'text'])

@php
    // One set of classes for every field, so all inputs look the same in light and dark mode
    $fieldClasses = 'mt-2 block w-full rounded-md border border-slate-300 bg-transparent px-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 transition focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900 dark:border-slate-700 dark:text-slate-200 dark:focus:border-slate-300 dark:focus:ring-slate-300';
@endphp

<div>
    <label for="{{ $name }}" class="text-sm font-medium text-slate-900 dark:text-slate-200">
        {{ $label }}
    </label>

    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="5" required {{ $attributes->merge(['class' => $fieldClasses]) }}></textarea>
    @else
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" required {{ $attributes->merge(['class' => $fieldClasses]) }}>
    @endif

    {{-- x-show: only visible when the server sent an error for this field; x-text fills in its first message --}}
    <p x-show="errors.{{ $name }}" x-text="errors.{{ $name }}?.[0]" x-cloak class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
</div>