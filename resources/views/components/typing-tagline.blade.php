{{-- Intro tagline that types and erases phrases. Usage: <x-typing-tagline :phrases="[...]" /> --}}
@props(['phrases'])

{{-- x-data: creates the Alpine component and passes it the list of phrases --}}
<p
    x-data="typingTagline(@js($phrases))"
    {{-- min-h reserves about two lines so the nav below does not jump as the text grows and shrinks --}}
    {{ $attributes->merge(['class' => 'mt-4 min-h-[3rem] max-w-xs leading-normal']) }}
>
    {{-- x-text: shows whatever the component is currently typing --}}
    <span x-text="displayedText"></span>
    {{-- The blinking caret is hidden from screen readers --}}
    <span class="typing-caret" aria-hidden="true">|</span>
    {{-- Screen readers get the first phrase once, instead of letter-by-letter noise --}}
    <span class="sr-only">{{ $phrases[0] }}</span>
</p>