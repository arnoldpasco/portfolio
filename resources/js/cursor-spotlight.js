// Moves a soft glow to follow the mouse by updating two CSS variables on <html>.
// Why CSS variables: the browser repaints one gradient, so there is no layout work per mouse move.

export function startCursorSpotlight() {
    // Skip on touch devices (no hover) and for people who asked for less motion.
    const hasFinePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!hasFinePointer || prefersReducedMotion) {
        return;
    }

    const rootElement = document.documentElement;
    let latestPointerX = 0;
    let latestPointerY = 0;
    let isUpdateScheduled = false;

    window.addEventListener('pointermove', (event) => {
        // Remember the newest position; the scheduled update below always uses this one.
        latestPointerX = event.clientX;
        latestPointerY = event.clientY;

        // Batch updates to at most one per screen frame.
        if (isUpdateScheduled) {
            return;
        }

        isUpdateScheduled = true;

        requestAnimationFrame(() => {
            rootElement.style.setProperty('--spotlight-x', `${latestPointerX}px`);
            rootElement.style.setProperty('--spotlight-y', `${latestPointerY}px`);

            // The glow stays invisible until the first real mouse move (see app.css).
            rootElement.classList.add('spotlight-active');

            isUpdateScheduled = false;
        });
    });
}