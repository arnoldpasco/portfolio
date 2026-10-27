// Alpine component that types and erases a list of phrases in the intro tagline.

export function typingTagline(phrases) {
    return {
        phrases,
        displayedText: '',
        phraseIndex: 0,
        isErasing: false,
        timerId: null,

        init() {
            // With reduced motion, show the first phrase as plain text and never animate.
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (prefersReducedMotion) {
                this.displayedText = this.phrases[0];
                return;
            }

            this.scheduleNextStep(400);
        },

        scheduleNextStep(delayInMilliseconds) {
            this.timerId = setTimeout(() => this.typeOrEraseOneCharacter(), delayInMilliseconds);
        },

        typeOrEraseOneCharacter() {
            const currentPhrase = this.phrases[this.phraseIndex];

            if (!this.isErasing) {
                this.displayedText = currentPhrase.slice(0, this.displayedText.length + 1);

                // Finished typing: pause so the phrase can be read, then start erasing.
                if (this.displayedText === currentPhrase) {
                    this.isErasing = true;
                    this.scheduleNextStep(1800);
                    return;
                }

                this.scheduleNextStep(70);
                return;
            }

            this.displayedText = currentPhrase.slice(0, this.displayedText.length - 1);

            // Finished erasing: move to the next phrase.
            if (this.displayedText === '') {
                this.isErasing = false;
                this.phraseIndex = (this.phraseIndex + 1) % this.phrases.length;
                this.scheduleNextStep(350);
                return;
            }

            this.scheduleNextStep(35);
        },

        // Stops the timer if Alpine removes this element.
        destroy() {
            clearTimeout(this.timerId);
        },
    };
}