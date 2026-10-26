{{-- Temporary home page for Phase 1: proves Tailwind, dark mode, and Alpine all work --}}
<x-layouts.app title="Your Name | Portfolio">
    <main class="mx-auto min-h-screen max-w-3xl px-6 py-24">
        <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
            Your Name
        </h1>
        <p class="mt-2 text-xl text-slate-600 dark:text-slate-300">
            Your Role Here
        </p>
        <p class="mt-6">
            Phase 1 setup works if you can read this, the toggle in the corner switches themes,
            and the button below slides its text open and closed.
        </p>

        {{-- x-data: Alpine state for this block. isOpen starts as false (closed) --}}
        <div x-data="{ isOpen: false }" class="mt-12">
            {{-- @click: flip isOpen between true and false --}}
            <button
                type="button"
                @click="isOpen = !isOpen"
                :aria-expanded="isOpen"
                class="rounded-md border border-slate-400 px-4 py-2 text-sm font-medium transition hover:bg-slate-100 dark:border-slate-600 dark:hover:bg-slate-800"
            >
                Alpine test: <span x-text="isOpen ? 'hide' : 'show'"></span>
            </button>

            {{-- x-show: visible only while isOpen is true. x-collapse: slides open instead of popping --}}
            <div x-show="isOpen" x-collapse>
                <p class="pt-4">It works. This text slid open with Alpine's collapse plugin. 🎉</p>
            </div>
        </div>
    </main>
</x-layouts.app>