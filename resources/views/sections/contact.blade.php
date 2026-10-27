{{-- Contact section content: short text + form. The form is only the markup for now; Phase 5 makes it send --}}
<p>
    Got a role, a project, or just a question? Send me a message and I'll get back to you soon.
</p>

{{-- x-data: wasSubmitted starts false. @submit.prevent stops the page from reloading.
     TODO Phase 5: replace this placeholder with a real fetch() call to the server --}}
<form
    method="POST"
    action="#"
    x-data="{ wasSubmitted: false }"
    @submit.prevent="wasSubmitted = true"
    class="mt-8 space-y-5"
>
    @csrf

    <x-form-field name="name" label="Your name" autocomplete="name" />
    <x-form-field name="email" label="Your email" type="email" autocomplete="email" />
    <x-form-field name="message" label="Message" type="textarea" />

    {{-- Spam trap (honeypot): hidden from people but bots fill it in. Phase 5 rejects any message where it is filled.
         tabindex=-1 and aria-hidden keep real visitors and screen readers away from it --}}
    <div class="absolute -left-[9999px]" aria-hidden="true">
        <label for="website">Leave this field empty</label>
        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
    </div>

    <button
        type="submit"
        class="group inline-flex items-center gap-2 rounded-md border border-slate-400 px-4 py-2 text-sm font-medium text-slate-900 transition hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800"
    >
        Send message
        <span class="transition-transform group-hover:translate-x-1" aria-hidden="true">→</span>
    </button>

    {{-- Temporary notice shown after clicking send (removed in Phase 5) --}}
    <p x-show="wasSubmitted" x-cloak x-transition class="text-sm text-slate-500">
        Thanks for trying it! The form isn't connected yet, so nothing was sent.
    </p>
</form>