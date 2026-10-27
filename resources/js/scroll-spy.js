// Scroll-spy: tracks which page section is being read so the nav can highlight it

// The "reading line": a section counts as active once its top edge reaches this many
// pixels from the top of the screen. It sits just below where a nav click lands a section
// (the sections use scroll-mt-24 = 96px), so a clicked link always highlights itself.
const READING_LINE_FROM_TOP_IN_PIXELS = 100;

export default (sectionIds) => ({
    // The section currently highlighted in the nav (starts with the first one)
    activeSectionId: sectionIds[0],

    // Alpine calls init() automatically when the component loads
    init() {
        this.updateActiveSection();

        // passive: true tells the browser this listener never blocks scrolling
        window.addEventListener('scroll', () => this.updateActiveSection(), { passive: true });

        // Zooming or resizing changes the layout, so we check again
        window.addEventListener('resize', () => this.updateActiveSection());
    },

    updateActiveSection() {
        // At the very bottom of the page a short last section may never reach the
        // reading line, so we highlight it manually
        const isAtPageBottom =
            window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 2;

        if (isAtPageBottom) {
            this.activeSectionId = sectionIds[sectionIds.length - 1];
            return;
        }

        // Start with the first section, then move forward through the list.
        // The last section whose top has passed the reading line wins.
        let currentSectionId = sectionIds[0];

        sectionIds.forEach((sectionId) => {
            const sectionElement = document.getElementById(sectionId);

            if (!sectionElement) {
                return;
            }

            const distanceFromTop = sectionElement.getBoundingClientRect().top;

            if (distanceFromTop <= READING_LINE_FROM_TOP_IN_PIXELS) {
                currentSectionId = sectionId;
            }
        });

        this.activeSectionId = currentSectionId;
    },
});