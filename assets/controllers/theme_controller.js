import { Controller } from '@hotwired/stimulus';

/**
 * @property {HTMLElement[]} toggleTargets
 */
export default class extends Controller {
    static targets = ['toggle'];

    connect() {
        this.#applyTheme(this.#storedTheme ?? this.#preferredTheme);

        window.matchMedia('(prefers-color-scheme: dark)')
            .addEventListener('change', this.#onSystemChange);
    }

    disconnect() {
        window.matchMedia('(prefers-color-scheme: dark)')
            .removeEventListener('change', this.#onSystemChange);
    }

    switch(event) {
        const theme = event.currentTarget.dataset.themeValue;
        localStorage.setItem('theme', theme);
        this.#applyTheme(theme);
    }

    #applyTheme(theme) {
        const resolved = theme === 'auto'
            ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
            : theme;

        document.documentElement.setAttribute('data-bs-theme', resolved);

        this.toggleTargets.forEach(el => {
            const isActive = el.dataset.themeValue === theme;
            el.classList.toggle('active', isActive);
            el.setAttribute('aria-pressed', String(isActive));
        });
    }

    #onSystemChange = () => {
        const stored = this.#storedTheme;
        if (stored !== 'light' && stored !== 'dark') {
            this.#applyTheme(this.#preferredTheme);
        }
    };

    get #storedTheme() { return localStorage.getItem('theme'); }
    get #preferredTheme() {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }
}
