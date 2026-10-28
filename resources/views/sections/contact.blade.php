{{-- Contact section content: short text + form that sends with fetch (no page reload) --}}
<p>
    Got a role, a project, or just a question? Send me a message and I'll get back to you soon.
</p>

{{-- x-data holds the form state:
     status = idle | sending | success | error (controls the button and the messages)
     errors = field errors sent back by the server (shown under each field)
     sendMessage() posts the form with fetch and handles each kind of reply.
     @submit.prevent stops the normal page-reloading submit.
     x-ref gives the code a handle on this form element. --}}
<form
    method="POST"
    action="{{ route('contact.store') }}"
    x-ref="contactForm"
    x-data="{
        status: 'idle',
        errors: {},
        errorMessage: '',
        async sendMessage() {
            this.status = 'sending';
            this.errors = {};

            try {
                const response = await fetch('{{ route('contact.store', absolute: false) }}', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    body: new FormData(this.$refs.contactForm),
                });

                if (response.status === 422) {
                    // Validation problem: show the messages under the fields
                    this.errors = (await response.json()).errors;
                    this.status = 'idle';
                    return;
                }

                if (response.status === 429) {
                    this.errorMessage = 'Too many messages in a short time. Please wait a minute and try again.';
                    this.status = 'error';
                    return;
                }

                if (!response.ok) {
                    throw new Error('Request failed');
                }

                this.$refs.contactForm.reset();
                this.status = 'success';
            } catch (error) {
                this.errorMessage = 'Something went wrong on my side. Please try again, or use the email link instead.';
                this.status = 'error';
            }
        },
    }"
    @submit.prevent="sendMessage()"
    class="mt-8 space-y-5"
>
    @csrf

    <x-form-field name="name" label="Your name" autocomplete="name" />
    <x-form-field name="email" label="Your email" type="email" autocomplete="email" />
    <x-form-field name="message" label="Message" type="textarea" />

    {{-- Spam trap (honeypot): hidden from people but bots fill it in. The server quietly ignores any message where it is filled.
         tabindex=-1 and aria-hidden keep real visitors and screen readers away from it --}}
    <div class="absolute -left-[9999px]" aria-hidden="true">
        <label for="website">Leave this field empty</label>
        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
    </div>

    {{-- :disabled stops double clicks while sending; x-text swaps the label --}}
    <button
        type="submit"
        :disabled="status === 'sending'"
        class="group inline-flex items-center gap-2 rounded-md border border-slate-400 px-4 py-2 text-sm font-medium text-slate-900 transition hover:bg-slate-100 disabled:cursor-wait disabled:opacity-60 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800"
    >
        <span x-text="status === 'sending' ? 'Sending...' : 'Send message'"></span>
        <span class="transition-transform group-hover:translate-x-1" aria-hidden="true">&rarr;</span>
    </button>

    {{-- aria-live makes screen readers announce whichever message appears --}}
    <div aria-live="polite">
        <p x-show="status === 'success'" x-cloak x-transition class="text-sm text-slate-900 dark:text-slate-200">
            Thanks! Your message is on its way. I'll reply soon.
        </p>
        <p x-show="status === 'error'" x-cloak x-transition x-text="errorMessage" class="text-sm text-red-600 dark:text-red-400"></p>
    </div>
</form>