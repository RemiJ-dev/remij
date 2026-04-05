// start the Stimulus application
import './bootstrap.js';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

// Applied immediately to prevent flash of wrong theme
const stored = localStorage.getItem('theme');
const preferred = stored ?? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
document.documentElement.setAttribute('data-bs-theme', preferred);
