// Scroll-spy: tracks which page section is on screen so the nav can highlight it

export default (sectionIds) => ({
    // The section currently highlighted in the nav (starts with the first one)
    activeSectionId: sectionIds[0],

    // Alpine calls init() automatically when the component loads
    init() {
        // The observer fires whenever a section crosses the "reading line"
        // The rootMargin shrinks the watched area to a thin band near the middle of the screen
        const sectionObserver = new IntersectionObserver(
            (observedEntries) => {
                observedEntries.forEach((observedEntry) => {
                    if (observedEntry.isIntersecting) {
                        this.activeSectionId = observedEntry.target.id;
                    }
                });
            },
            { rootMargin: '-40% 0px -55% 0px' }
        );

        sectionIds.forEach((sectionId) => {
            const sectionElement = document.getElementById(sectionId);

            if (sectionElement) {
                sectionObserver.observe(sectionElement);
            }
        });

        // At the very bottom of the page a short last section may never reach the
        // reading line, so we highlight it manually
        window.addEventListener('scroll', () => {
            const isAtPageBottom =
                window.innerHeight + window.scrollY >= document.body.offsetHeight - 2;

            if (isAtPageBottom) {
                this.activeSectionId = sectionIds[sectionIds.length - 1];
            }
        });
    },
});