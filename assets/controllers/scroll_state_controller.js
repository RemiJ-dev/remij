import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static classes = ['active']

    static values = {
        target: String,
    }

    connect() {
        this.scrollSource.addEventListener('scroll', this.update, {
            passive: true,
        })

        this.update()
    }

    disconnect() {
        this.scrollSource.removeEventListener('scroll', this.update)
    }

    update = () => {
        this.targetElement.classList.toggle(
            this.activeClass,
            this.element.scrollTop > 5
        )
    }

    get scrollSource() {
        return this.element === document.documentElement
            ? window
            : this.element
    }

    get targetElement() {
        if (!this.hasTargetValue) {
            return this.element
        }

        return this.element.querySelector(
            `[data-scroll-state-target="${CSS.escape(this.targetValue)}"]`
        )
    }
}
