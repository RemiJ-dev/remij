import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.onClick = this.onClick.bind(this);
        this.element.addEventListener('click', this.onClick);
    }

    disconnect() {
        this.element.removeEventListener('click', this.onClick);
    }

    onClick() {
        document.body.scrollTo?.({
            top: 0,
            behavior: 'smooth',
        });

        document.documentElement.scrollTo?.({
            top: 0,
            behavior: 'smooth',
        });

        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
}
