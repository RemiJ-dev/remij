import { Controller } from '@hotwired/stimulus';

/**
 * ToggleClassController
 *
 * Ajoute ou retire une ou plusieurs classes CSS au clic sur un élément.
 *
 * Par défaut, les classes sont appliquées uniquement sur l'élément déclencheur.
 * Il est également possible de synchroniser l'état avec une ou plusieurs
 * targets grâce à un identifiant de groupe.
 *
 *
 * --------------------------------------------------------------------------
 * Configuration du controller
 * --------------------------------------------------------------------------
 *
 * Valeurs :
 *
 * - defaultClass : classe(s) utilisée(s) lorsque le paramètre `name`
 *                  n'est pas renseigné.
 *                  Défaut : "active"
 *
 * - accordion    : active le comportement accordéon.
 *                  Défaut : false
 *
 *
 * Exemple :
 *
 * <div
 *     data-controller="toggle-class"
 *     data-toggle-class-default-class-value="active"
 *     data-toggle-class-accordion-value="false"
 * >
 *     ...
 * </div>
 *
 *
 * --------------------------------------------------------------------------
 * 1. Toggle simple sur le trigger
 * --------------------------------------------------------------------------
 *
 * La classe est ajoutée / retirée directement sur l'élément cliqué.
 *
 * Twig :
 *
 * <button
 *     {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *         name: 'active'
 *     }) }}
 * >
 *     Toggle
 * </button>
 *
 * `name` peut être omis pour utiliser `defaultClass`.
 *
 *
 * --------------------------------------------------------------------------
 * 2. Plusieurs classes
 * --------------------------------------------------------------------------
 *
 * Plusieurs classes peuvent être passées dans `name`, séparées par des
 * espaces. Elles sont toujours ajoutées / retirées ensemble.
 *
 * <button
 *     {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *         name: 'active is-open'
 *     }) }}
 * >
 *     Toggle
 * </button>
 *
 *
 * --------------------------------------------------------------------------
 * 3. Toggle du trigger + une target
 * --------------------------------------------------------------------------
 *
 * Le paramètre `group` du trigger permet de l'associer à une target portant
 * le même `data-group`.
 *
 * <button
 *     {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *         name: 'active',
 *         group: 'menu'
 *     }) }}
 * >
 *     Toggle menu
 * </button>
 *
 * <div
 *     data-toggle-class-target="target"
 *     data-group="menu"
 * >
 *     ...
 * </div>
 *
 * La classe `active` est alors synchronisée sur le bouton ET sur la target.
 *
 *
 * --------------------------------------------------------------------------
 * 4. Toggle du trigger + plusieurs targets
 * --------------------------------------------------------------------------
 *
 * Plusieurs targets peuvent appartenir au même groupe.
 *
 * <button
 *     {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *         group: 'menu'
 *     }) }}
 * >
 *     Toggle menu
 * </button>
 *
 * <div data-toggle-class-target="target" data-group="menu">
 *     ...
 * </div>
 *
 * <div data-toggle-class-target="target" data-group="menu">
 *     ...
 * </div>
 *
 * Toutes les targets du groupe sont synchronisées avec le trigger.
 *
 *
 * --------------------------------------------------------------------------
 * 5. Plusieurs groupes indépendants
 * --------------------------------------------------------------------------
 *
 * <button
 *     {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *         group: 'first'
 *     }) }}
 * >
 *     First
 * </button>
 *
 * <div data-toggle-class-target="target" data-group="first">
 *     ...
 * </div>
 *
 * <button
 *     {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *         group: 'second'
 *     }) }}
 * >
 *     Second
 * </button>
 *
 * <div data-toggle-class-target="target" data-group="second">
 *     ...
 * </div>
 *
 * En mode normal (`accordion = false`), chaque groupe est indépendant.
 *
 *
 * --------------------------------------------------------------------------
 * 6. Mode accordéon
 * --------------------------------------------------------------------------
 *
 * Avec `accordion = true`, une seule entrée peut être active à la fois
 * dans le scope du controller.
 *
 * Au clic :
 *
 * - si le trigger est déjà actif :
 *     toutes les classes sont retirées ;
 *
 * - sinon :
 *     toutes les entrées sont désactivées, puis les classes sont ajoutées
 *     au trigger courant et à ses targets.
 *
 * Exemple :
 *
 * <div
 *     data-controller="toggle-class"
 *     data-toggle-class-accordion-value="true"
 * >
 *     <button
 *         {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *             group: 'faq-1'
 *         }) }}
 *     >
 *         Question 1
 *     </button>
 *
 *     <div data-toggle-class-target="target" data-group="faq-1">
 *         Réponse 1
 *     </div>
 *
 *     <button
 *         {{ stimulus_action('toggle-class', 'toggle', 'click', {
 *             group: 'faq-2'
 *         }) }}
 *     >
 *         Question 2
 *     </button>
 *
 *     <div data-toggle-class-target="target" data-group="faq-2">
 *         Réponse 2
 *     </div>
 * </div>
 *
 *
 * --------------------------------------------------------------------------
 * Notes
 * --------------------------------------------------------------------------
 *
 * - Sans `group`, aucune target n'est utilisée : seul le trigger est modifié.
 *
 * - Une target doit avoir :
 *
 *     data-toggle-class-target="target"
 *
 *   ainsi qu'un :
 *
 *     data-group="..."
 *
 *   correspondant au paramètre `group` du trigger.
 *
 * - Toutes les targets doivent se trouver dans le scope du controller.
 *
 * - En mode accordéon, la fermeture des autres éléments concerne toute
 *   l'instance du controller. Utiliser plusieurs controllers distincts pour
 *   obtenir plusieurs accordéons indépendants.
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
