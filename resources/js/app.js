// Entry point for JavaScript: loads Alpine.js, its plugins, and our own Alpine components
import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import scrollSpy from './scroll-spy';
import { typingTagline } from './typing-tagline';
import { startCursorSpotlight } from './cursor-spotlight';
import { startScrollReveal } from './scroll-reveal';

// The collapse plugin powers the x-collapse directive used for expanding sections
Alpine.plugin(collapse);

// Register the scroll-spy so Blade can use it as x-data="scrollSpy([...])"
Alpine.data('scrollSpy', scrollSpy);

// Register the typing effect so Blade can use it as x-data="typingTagline([...])"
Alpine.data('typingTagline', typingTagline);

// Make Alpine reachable from the browser console, handy while learning
window.Alpine = Alpine;

Alpine.start();

// Plain JavaScript (not Alpine): makes the background glow follow the mouse
startCursorSpotlight();

// Plain JavaScript (not Alpine): fades sections in as they scroll into view
startScrollReveal();