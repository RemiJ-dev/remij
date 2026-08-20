import { Controller } from '@hotwired/stimulus';

/**
 * ToggleClassController (Stimulus)
 *
 * Objectif :
 * - Ajouter / retirer une ou plusieurs classes CSS sur un élément "trigger"
 *   et éventuellement sur un ou plusieurs "targets"
 *
 * API :
 * - via stimulus_action() + params :
 *   {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *       name: 'active',
 *       group: 'faq-1'
 *   }) }}
 *
 * Comportements :
 * - accordion = false (défaut) :
 *   -> toggle normal sur le trigger + les targets du group
 *
 * - accordion = true :
 *   -> au clic sur un item :
 *      - si l’item est déjà actif : on retire les classes partout
 *      - sinon :
 *          1) on retire les classes partout
 *          2) on ajoute les classes sur l’item cliqué + ses targets
 */
export default class extends Controller {

    static targets = ['target'];

    static values = {
        defaultClass: { type: String, default: 'active' },
        accordion: { type: Boolean, default: false },
    };

    toggle(event) {
        const trigger = event.currentTarget;

        // 1) Classes à appliquer
        const raw = event.params?.name || this.defaultClassValue;

        const classes = String(raw)
            .trim()
            .split(/\s+/)
            .filter(Boolean);

        if (!classes.length) {
            return;
        }

        // 2) Groupe éventuel
        // dataset retourne toujours une String, on normalise donc ici aussi.
        const group = event.params?.group
            ? String(event.params.group)
            : null;

        // 3) État actuel du trigger
        // Toutes les classes demandées doivent être présentes pour que
        // l'élément soit considéré comme actif.
        const isActive = classes.every((cls) =>
            trigger.classList.contains(cls)
        );

        // 4) Mode accordéon
        if (this.accordionValue) {
            // Re-clic sur l'élément actif : fermeture complète
            if (isActive) {
                this.#clearAll(classes);
                return;
            }

            // Sinon : fermeture de tous les éléments puis ouverture
            // du trigger courant et de ses targets associées.
            this.#clearAll(classes);

            this.#apply(
                this.#resolveElements(trigger, group),
                classes,
                'add'
            );

            return;
        }

        // 5) Mode normal
        // On détermine l'état depuis le trigger puis on applique le même
        // état au trigger et à toutes ses targets afin d'éviter qu'ils
        // puissent se désynchroniser.
        this.#apply(
            this.#resolveElements(trigger, group),
            classes,
            isActive ? 'remove' : 'add'
        );
    }

    // ------------------------------------------------------------------
    // Helpers
    // ------------------------------------------------------------------

    /**
     * Retourne le trigger et les targets appartenant au même groupe.
     */
    #resolveElements(trigger, group) {
        const elements = [trigger];

        if (!this.hasTargetTarget || !group) {
            return elements;
        }

        const targets = this.targetTargets.filter(
            (el) => el.dataset.group === group
        );

        return elements.concat(targets);
    }

    /**
     * Retire les classes sur tous les triggers et toutes les targets
     * du scope du controller.
     */
    #clearAll(classes) {
        const triggers = this.element.querySelectorAll(
            '[data-action*="toggle-class#toggle"]'
        );

        this.#apply(
            Array.from(triggers),
            classes,
            'remove'
        );

        if (this.hasTargetTarget) {
            this.#apply(
                this.targetTargets,
                classes,
                'remove'
            );
        }
    }

    /**
     * Applique une opération de classes à une collection d'éléments.
     */
    #apply(elements, classes, mode) {
        elements.forEach((element) => {
            classes.forEach((className) => {
                if (mode === 'add') {
                    element.classList.add(className);
                }

                if (mode === 'remove') {
                    element.classList.remove(className);
                }
            });
        });
    }
}
