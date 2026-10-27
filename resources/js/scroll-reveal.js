// Fades and slides page sections up as they scroll into view, using the browser's IntersectionObserver.
// Anything already on screen at load is left alone, so there is no flash and no needless animation.

export function startScrollReveal() {
    // With reduced motion, nothing is ever hidden, so everything is simply visible.
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        return;
    }

    const elementsToReveal = document.querySelectorAll('[data-reveal]');

    // Watches elements and fires when one enters the screen.
    // The negative bottom margin waits until the element is slightly inside the screen, not just touching the edge.
    const revealObserver = new IntersectionObserver(
        (observedEntries) => {
            observedEntries.forEach((observedEntry) => {
                if (!observedEntry.isIntersecting) {
                    return;
                }

                // Removing the hidden class lets the CSS transition play.
                observedEntry.target.classList.remove('reveal-hidden');

                // Reveal once only: stop watching so scrolling back up does not replay it.
                revealObserver.unobserve(observedEntry.target);
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -8% 0px' }
    );

    elementsToReveal.forEach((elementToReveal) => {
        const isAlreadyOnScreen = elementToReveal.getBoundingClientRect().top < window.innerHeight;

        // Already visible at load (or after a refresh mid-page): leave it as is.
        if (isAlreadyOnScreen) {
            return;
        }

        // Only below-the-fold elements are hidden, so hiding them cannot cause a visible flash.
        elementToReveal.classList.add('reveal', 'reveal-hidden');
        revealObserver.observe(elementToReveal);
    });
}