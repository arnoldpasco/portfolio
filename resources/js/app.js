// Entry point for JavaScript: loads Alpine.js and its collapse (smooth expand/close) plugin
import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// The collapse plugin powers the x-collapse directive used for expanding sections
Alpine.plugin(collapse);

// Make Alpine reachable from the browser console, handy while learning
window.Alpine = Alpine;

Alpine.start();