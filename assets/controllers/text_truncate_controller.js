import { Controller } from '@hotwired/stimulus';

/**
 * Text truncate component.
 *
 * Usage:
 * - Add `data-controller="text-truncate"` on a wrapper element.
 * - The first direct child element is treated as the content to truncate.
 * - Add `data-text-truncate-state="closed"` on this content element if you want
 *   it collapsed by default before JavaScript initialization.
 * - The first button found inside the wrapper is treated as the toggle button.
 * - The first span found inside that button is treated as the optional label.
 *
 * Optional values on the wrapper:
 * - `data-text-truncate-lines-value="5"` to define the collapsed height in number of lines
 * - `data-text-truncate-mobile-only-value="true"` to apply truncation only on mobile
 * - `data-text-truncate-more-label-value="Voir plus"` for the collapsed button label
 * - `data-text-truncate-less-label-value="Voir moins"` for the expanded button label
 *
 * Expected markup:
 *
 * <div data-controller="text-truncate">
 *   <div data-text-truncate-state="closed">...</div>
 *   <button hidden class="button-toggle collapsed">
 *     <span>Voir plus</span>
 *   </button>
 * </div>
 */

// Width threshold used when truncation must apply only on mobile.
const MOBILE_WIDTH_THRESHOLD = 768;

// Fallback ratio used when the browser returns "normal" for line-height.
const LINE_HEIGHT_RATIO_FALLBACK = 1.3;

export default class extends Controller {
    static values = {
        lines: { type: Number, default: 5 },
        mobileOnly: { type: Boolean, default: false },
        moreLabel: { type: String, default: 'Voir plus' },
        lessLabel: { type: String, default: 'Voir moins' },
    };

    connect() {
        // Resolve internal elements using simple DOM conventions.
        this.textElement = this.element.firstElementChild;
        this.buttonElement = this.element.querySelector('button');
        this.labelElement = this.buttonElement?.querySelector('span') || null;

        if (!this.textElement || !this.buttonElement) {
            return;
        }

        // Bind callbacks once so they can safely be removed in disconnect().
        this.onResize = this.onResize.bind(this);
        this.onButtonClick = this.onButtonClick.bind(this);

        // Store current viewport width to avoid unnecessary recalculations.
        this.lastWidth = window.innerWidth;

        // Used to debounce resize calculations with requestAnimationFrame.
        this.resizeRaf = null;
        this.animationRaf = null;

        // Tracks whether the component has already been initialized.
        this.hasInitialized = false;

        window.addEventListener('resize', this.onResize, { passive: true });
        this.buttonElement.addEventListener('click', this.onButtonClick);

        this.refresh();
    }

    disconnect() {
        window.removeEventListener('resize', this.onResize);

        if (this.buttonElement) {
            this.buttonElement.removeEventListener('click', this.onButtonClick);
        }

        if (this.resizeRaf) {
            cancelAnimationFrame(this.resizeRaf);
        }

        if (this.animationRaf) {
            cancelAnimationFrame(this.animationRaf);
        }
    }

    // Public method that can be called again after AJAX content changes.
    refresh() {
        if (!this.textElement || !this.buttonElement) {
            return;
        }

        const collapsedHeight = this.getCollapsedHeight();
        const fullHeight = this.getContentHeight();

        // Keep previous state after refresh().
        // On first init, default to the HTML state if present, otherwise collapsed.
        const wasClosed = this.hasInitialized
            ? this.isClosed()
            : this.textElement.getAttribute('data-text-truncate-state') !== 'open';

        const mustTruncate = this.shouldApplyTruncation() && fullHeight > collapsedHeight + 1;

        // Expose useful CSS variable for the collapsed height.
        this.textElement.style.setProperty('--truncate-collapsed-height', `${collapsedHeight}px`);

        if (mustTruncate) {
            this.buttonElement.hidden = false;

            if (wasClosed) {
                this.setClosedState(true);
                this.textElement.style.maxHeight = `${collapsedHeight}px`;
            } else {
                this.setClosedState(false);
                this.textElement.style.maxHeight = `${fullHeight}px`;
            }
        } else {
            // If the content does not overflow, reset everything.
            this.setClosedState(false);
            this.textElement.style.maxHeight = '';
            this.buttonElement.hidden = true;
        }

        this.updateButtonState();
        this.hasInitialized = true;
    }

    onButtonClick(event) {
        event.preventDefault();

        // Ignore interaction when the component is inactive.
        if (!this.textElement || !this.buttonElement || this.buttonElement.hidden) {
            return;
        }

        if (this.isClosed()) {
            this.expand();
        } else {
            this.collapse();
        }
    }

    expand() {
        if (this.animationRaf) {
            cancelAnimationFrame(this.animationRaf);
        }

        const fullHeight = this.getContentHeight();

        // Start from the current rendered height.
        this.textElement.style.maxHeight = `${this.textElement.offsetHeight}px`;

        // Remove the collapsed state immediately so the button state and fade update.
        this.setClosedState(false);
        this.updateButtonState();

        // Animate to the full content height.
        this.animationRaf = requestAnimationFrame(() => {
            this.textElement.style.maxHeight = `${fullHeight}px`;
        });
    }

    collapse() {
        if (this.animationRaf) {
            cancelAnimationFrame(this.animationRaf);
        }

        const fullHeight = this.getContentHeight();
        const collapsedHeight = this.getCollapsedHeight();

        // Start from the full height.
        this.textElement.style.maxHeight = `${fullHeight}px`;

        // Apply the collapsed state immediately so the button state and fade update.
        this.setClosedState(true);
        this.updateButtonState();

        // Animate back to the collapsed height.
        this.animationRaf = requestAnimationFrame(() => {
            this.textElement.style.maxHeight = `${collapsedHeight}px`;
        });
    }

    onResize() {
        if (this.resizeRaf) {
            cancelAnimationFrame(this.resizeRaf);
        }

        this.resizeRaf = requestAnimationFrame(() => {
            const currentWidth = window.innerWidth;

            // Only refresh when width actually changes.
            if (currentWidth === this.lastWidth) {
                return;
            }

            this.lastWidth = currentWidth;
            this.refresh();
        });
    }

    shouldApplyTruncation() {
        // Apply everywhere by default.
        // If mobileOnly=true, apply only below the mobile threshold.
        return !this.mobileOnlyValue || window.innerWidth < MOBILE_WIDTH_THRESHOLD;
    }

    getCollapsedHeight() {
        const lineHeight = this.getReferenceLineHeight();
        return lineHeight * this.linesValue;
    }

    getReferenceLineHeight() {
        const computedStyle = window.getComputedStyle(this.textElement);

        const fontSize = parseFloat(computedStyle.fontSize) || 16;
        let lineHeight = parseFloat(computedStyle.lineHeight);

        // Browsers may return "normal" for line-height, which is not directly usable.
        if (Number.isNaN(lineHeight)) {
            lineHeight = fontSize * LINE_HEIGHT_RATIO_FALLBACK;
        }

        return lineHeight;
    }

    getContentHeight() {
        return this.textElement.scrollHeight;
    }

    isClosed() {
        return this.textElement.getAttribute('data-text-truncate-state') === 'closed';
    }

    setClosedState(isClosed) {
        if (isClosed) {
            this.textElement.setAttribute('data-text-truncate-state', 'closed');
        } else {
            this.textElement.removeAttribute('data-text-truncate-state');
        }
    }

    updateButtonState() {
        if (!this.buttonElement) {
            return;
        }

        if (this.buttonElement.hidden) {
            this.buttonElement.setAttribute('aria-expanded', 'false');
            this.buttonElement.classList.add('collapsed');
            return;
        }

        const isClosed = this.isClosed();
        const nextLabel = isClosed ? this.moreLabelValue : this.lessLabelValue;

        if (this.labelElement) {
            this.labelElement.textContent = nextLabel;
        } else {
            this.buttonElement.textContent = nextLabel;
        }

        this.buttonElement.classList.toggle('collapsed', isClosed);
        this.buttonElement.setAttribute('aria-expanded', String(!isClosed));
    }
}
