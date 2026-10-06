<?php

declare(strict_types=1);

namespace App\Infrastructure\Stenope\Processor;

use Stenope\Bundle\Behaviour\HtmlCrawlerManagerInterface;
use Stenope\Bundle\Behaviour\ProcessorInterface;
use Stenope\Bundle\Content;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

/**
 * Inline dans le contenu HTML les SVG produits par D2, et branche leur thème
 * sombre sur l'attribut `data-bs-theme` du site.
 *
 * Un SVG référencé via `<img>` est rendu par le navigateur dans un contexte
 * isolé : il ne « voit » pas l'attribut `data-bs-theme` du document hôte, et sa
 * media query `prefers-color-scheme` suit les préférences de l'OS plutôt que le
 * thème choisi sur le site. On inline donc le SVG dans le HTML, puis on rebranche
 * ses règles sombres sur `[data-bs-theme="dark"]`.
 *
 * La media query d'origine n'est pas conservée : `assets/app.js` résout toujours
 * le thème en `light` ou `dark` explicite avant de le poser sur `<html>`. La garder
 * ferait diverger le diagramme de sa page tant que le JS n'a pas tourné — fond clair
 * (défaut Bootstrap) et schéma sombre — et doublerait le poids des règles sombres.
 *
 * Cette isolation perdue doit être reconstruite : D2 laisse une partie de ses
 * règles non qualifiées (`.shape`, `.connection`, `.blend`, `.md`, `.light-code`,
 * `.sketch-overlay-*`…). Inertes tant que le SVG vivait dans son propre document,
 * elles s'appliqueraient à toute la page une fois inlinées. Toutes les règles sont
 * donc scopées sur la racine du diagramme — ce qui règle du même coup la collision
 * des `.sketch-overlay-*` entre deux diagrammes d'une même page, dont les dégradés
 * sont identifiés par diagramme mais les sélecteurs communs.
 *
 * Doit tourner AVANT l'AssetsProcessor de Stenope, qui réécrit les `src` en URL
 * publique — d'où la priorité portée par `#[AsTaggedItem]`.
 */
#[AsTaggedItem(priority: 100)]
class D2DiagramProcessor implements ProcessorInterface
{
    /** Attribut présent sur la racine de tout SVG produit par D2. */
    private const string D2_MARKER = 'data-d2-version';

    /** Racine du diagramme, sur laquelle toutes ses règles sont scopées. */
    private const string SCOPE = 'svg[' . self::D2_MARKER . ']';

    /** At-rules dont le corps contient des règles de style à scoper à leur tour. */
    private const array NESTED_AT_RULES = ['media', 'supports', 'layer', 'container'];

    /**
     * Balisage déjà réécrit, indexé par fichier source et date de modification.
     * `null` mémorise un asset qui n'est pas un diagramme D2, pour ne pas le relire.
     *
     * @var array<string, string|null>
     */
    private array $diagrams = [];

    public function __construct(
        private readonly AssetMapperInterface $assetMapper,
        private readonly HtmlCrawlerManagerInterface $crawlers,
        private readonly string $property = 'content',
    ) {
    }

    /**
     * @param array<array-key, mixed> $data
     */
    public function __invoke(array &$data, Content $content): void
    {
        if (!isset($data[$this->property])) {
            return;
        }

        $crawler = $this->crawlers->get($content, $data, $this->property);

        if (\is_null($crawler)) {
            return;
        }

        $replaced = false;

        /** @var \DOMElement $element */
        foreach (iterator_to_array($crawler->filter('img')) as $element) {
            $replaced = $this->inline($element) || $replaced;
        }

        if ($replaced) {
            $this->crawlers->save($content, $data, $this->property);
        }
    }

    /**
     * Remplace l'`<img>` par le contenu du SVG s'il s'agit d'un diagramme D2.
     */
    private function inline(\DOMElement $element): bool
    {
        // Une `<img>` détachée du document n'est remplaçable par rien : le signaler
        // évite de déclencher une re-sérialisation complète pour un document intact.
        $parent = $element->parentNode;

        if (\is_null($parent)) {
            return false;
        }

        $markup = $this->resolveDiagram($element->getAttribute('src'));

        if (\is_null($markup)) {
            return false;
        }

        $svg = $this->importSvg($element, $markup);

        if (\is_null($svg)) {
            return false;
        }

        // Le SVG inline n'est pas remplaçable par un texte alternatif : on porte
        // l'équivalent accessible de l'`<img>` sur l'élément lui-même.
        $alt = trim($element->getAttribute('alt'));

        if ('' !== $alt) {
            $svg->setAttribute('role', 'img');
            $svg->setAttribute('aria-label', $alt);
        } else {
            $svg->setAttribute('aria-hidden', 'true');
        }

        $parent->replaceChild($svg, $element);

        return true;
    }

    /**
     * Balisage prêt à inliner pour cet asset, ou `null` s'il ne s'agit pas d'un
     * diagramme D2.
     *
     * Mémoïsé : un même diagramme peut être référencé par plusieurs contenus, et
     * un SVG étranger à D2 (logo, icône) serait sinon relu intégralement à chaque
     * occurrence pour être rejeté sur un simple `str_contains`.
     */
    private function resolveDiagram(string $src): ?string
    {
        if (!str_ends_with($src, '.svg')) {
            return null;
        }

        $asset = $this->assetMapper->getAsset($src);

        if (\is_null($asset) || !is_readable($asset->sourcePath)) {
            return null;
        }

        // La date de modification entre dans la clé : en mode worker, le processus
        // survit aux éditions de fichiers, et un cache indexé sur le seul chemin
        // resservirait indéfiniment un diagramme périmé.
        $modifiedAt = filemtime($asset->sourcePath);
        $key = \sprintf('%s:%d', $asset->sourcePath, false === $modifiedAt ? 0 : $modifiedAt);

        if (\array_key_exists($key, $this->diagrams)) {
            return $this->diagrams[$key];
        }

        return $this->diagrams[$key] = $this->readDiagram($asset->sourcePath);
    }

    /**
     * Lit et réécrit le fichier source d'un asset local, s'il s'agit bien d'un SVG D2.
     */
    private function readDiagram(string $path): ?string
    {
        $contents = file_get_contents($path);

        if (false === $contents || !str_contains($contents, self::D2_MARKER)) {
            return null;
        }

        return $this->rewriteStyleSheets($contents);
    }

    /**
     * Parse le SVG et l'importe dans le document du contenu.
     */
    private function importSvg(\DOMElement $element, string $svg): ?\DOMElement
    {
        $document = new \DOMDocument();

        $previous = libxml_use_internal_errors(true);

        try {
            $loaded = $document->loadXML($svg);
        } finally {
            // Le buffer d'erreurs libxml est global au processus. Ne le vider que
            // si personne ne l'utilisait avant nous : un appelant qui collectait
            // déjà ses propres diagnostics les perdrait sinon en silence.
            if (!$previous) {
                libxml_clear_errors();
            }

            libxml_use_internal_errors($previous);
        }

        if (!$loaded || \is_null($document->documentElement) || \is_null($element->ownerDocument)) {
            return null;
        }

        $imported = $element->ownerDocument->importNode($document->documentElement, true);

        return $imported instanceof \DOMElement ? $imported : null;
    }

    /**
     * Réécrit chaque élément `<style>` embarqué dans le SVG.
     */
    private function rewriteStyleSheets(string $svg): string
    {
        $offset = 0;

        while (true) {
            $tag = strpos($svg, '<style', $offset);

            if (false === $tag) {
                return $svg;
            }

            $start = strpos($svg, '>', $tag);

            if (false === $start) {
                return $svg;
            }

            ++$start;
            $end = strpos($svg, '</style>', $start);

            if (false === $end) {
                return $svg;
            }

            $rewritten = $this->rewriteStyleSheet(substr($svg, $start, $end - $start));
            $svg = substr_replace($svg, $rewritten, $start, $end - $start);
            $offset = $start + \strlen($rewritten);
        }
    }

    /**
     * Scope le contenu d'un `<style>`, en préservant l'enveloppe CDATA de D2.
     */
    private function rewriteStyleSheet(string $content): string
    {
        $open = strpos($content, '<![CDATA[');

        if (false === $open) {
            return $this->scopeRules($content, self::SCOPE);
        }

        $open += \strlen('<![CDATA[');
        $close = strrpos($content, ']]>');

        if (false === $close || $close < $open) {
            return $this->scopeRules($content, self::SCOPE);
        }

        return substr($content, 0, $open)
            . $this->scopeRules(substr($content, $open, $close - $open), self::SCOPE)
            . substr($content, $close);
    }

    /**
     * Parcourt une liste de règles CSS et préfixe chaque sélecteur par $scope.
     *
     * Le parcours distingue les at-rules des règles de style : préfixer un
     * `@font-face` produirait une règle que les navigateurs jettent, et les
     * polices du diagramme disparaîtraient sans la moindre erreur.
     */
    private function scopeRules(string $css, string $scope): string
    {
        $result = '';
        $offset = 0;
        $length = \strlen($css);

        while ($offset < $length) {
            $stop = $offset + strcspn($css, '{;', $offset);

            // Reliquat sans bloc ni instruction : conservé tel quel.
            if ($stop >= $length) {
                return $result . substr($css, $offset);
            }

            $prelude = substr($css, $offset, $stop - $offset);

            // At-statement (`@charset`, `@import`…) : pas de bloc, rien à scoper.
            if (';' === $css[$stop]) {
                $result .= $prelude . ';';
                $offset = $stop + 1;

                continue;
            }

            $end = $this->findClosingBrace($css, $stop + 1);

            if (\is_null($end)) {
                return $result . substr($css, $offset);
            }

            $result .= $this->scopeBlock($prelude, substr($css, $stop + 1, $end - $stop - 1), $scope);
            $offset = $end + 1;
        }

        return $result;
    }

    /**
     * Scope un bloc « prélude { corps } ».
     */
    private function scopeBlock(string $prelude, string $body, string $scope): string
    {
        $trimmed = trim($prelude);

        if (!str_starts_with($trimmed, '@')) {
            $selectors = $this->splitSelectors($trimmed);

            if ([] === $selectors) {
                return \sprintf('%s{%s}', $trimmed, $body);
            }

            return \sprintf('%s{%s}', $this->prefixSelectors($selectors, $scope), $body);
        }

        $name = strtolower(substr($trimmed, 1, strcspn($trimmed, " \t\r\n(", 1)));

        // `@font-face`, `@keyframes`, `@page`… : leur corps ne contient aucun
        // sélecteur de document, le scoper n'aurait pas de sens.
        if (!\in_array($name, self::NESTED_AT_RULES, true)) {
            return \sprintf('%s{%s}', $trimmed, $body);
        }

        // La media query sombre de D2 suit les préférences de l'OS. On la remplace
        // — sans la conserver — par le seul thème du site : `app.js` résout toujours
        // `data-bs-theme` en `light` ou `dark` explicite, la media query n'apporte
        // donc rien. La garder ferait même diverger le diagramme de sa page tant
        // que le JS n'a pas tourné : fond clair (défaut Bootstrap) et schéma sombre.
        if ($this->isDarkMediaQuery($name, $trimmed)) {
            return $this->scopeRules($body, \sprintf('[data-bs-theme="dark"] %s', $scope));
        }

        return \sprintf('%s{%s}', $trimmed, $this->scopeRules($body, $scope));
    }

    /**
     * Une media query émise par D2 pour `--dark-theme`.
     */
    private function isDarkMediaQuery(string $name, string $prelude): bool
    {
        if ('media' !== $name) {
            return false;
        }

        $normalized = strtolower((string) preg_replace('/\s+/', '', $prelude));

        return str_contains($normalized, 'prefers-color-scheme:dark');
    }

    /**
     * Position de l'accolade fermant le bloc ouvert en $open.
     */
    private function findClosingBrace(string $css, int $open): ?int
    {
        $depth = 1;
        $length = \strlen($css);

        for ($i = $open; $i < $length; ++$i) {
            $depth += match ($css[$i]) {
                '{' => 1,
                '}' => -1,
                default => 0,
            };

            if (0 === $depth) {
                return $i;
            }
        }

        return null;
    }

    /**
     * @param list<string> $selectors
     */
    private function prefixSelectors(array $selectors, string $scope): string
    {
        return implode(',', array_map(
            static fn (string $selector): string => \sprintf('%s %s', $scope, $selector),
            $selectors,
        ));
    }

    /**
     * Découpe une liste de sélecteurs sur ses virgules de premier niveau : celles
     * imbriquées dans `:is()`, `:not()` ou un sélecteur d'attribut sont conservées.
     *
     * @return list<string>
     */
    private function splitSelectors(string $selectors): array
    {
        $list = [];
        $current = '';
        $depth = 0;

        for ($i = 0, $length = \strlen($selectors); $i < $length; ++$i) {
            $char = $selectors[$i];

            $depth += match ($char) {
                '(', '[' => 1,
                ')', ']' => -1,
                default => 0,
            };

            if (',' === $char && 0 === $depth) {
                $list[] = $current;
                $current = '';

                continue;
            }

            $current .= $char;
        }

        $list[] = $current;

        return array_values(array_filter(
            array_map(trim(...), $list),
            static fn (string $selector): bool => '' !== $selector,
        ));
    }
}
