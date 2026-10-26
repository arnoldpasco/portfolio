// Entry point for JavaScript: loads Alpine.js, its plugins, and our own Alpine components
import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import scrollSpy from './scroll-spy';

// The collapse plugin powers the x-collapse directive used for expanding sections
Alpine.plugin(collapse);

// Register the scroll-spy so Blade can use it as x-data="scrollSpy([...])"
Alpine.data('scrollSpy', scrollSpy);

// Make Alpine reachable from the browser console, handy while learning
window.Alpine = Alpine;

Alpine.start();