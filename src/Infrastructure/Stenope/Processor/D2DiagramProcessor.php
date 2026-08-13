<?php

declare(strict_types=1);

namespace App\Infrastructure\Stenope\Processor;

use Stenope\Bundle\Behaviour\HtmlCrawlerManagerInterface;
use Stenope\Bundle\Behaviour\ProcessorInterface;
use Stenope\Bundle\Content;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/**
 * Inline dans le contenu HTML les SVG produits par D2, et branche leur thème
 * sombre sur l'attribut `data-bs-theme` du site.
 *
 * Un SVG référencé via `<img>` est rendu par le navigateur dans un contexte
 * isolé : il ne « voit » pas l'attribut `data-bs-theme` du document hôte, et sa
 * media query `prefers-color-scheme` suit les préférences de l'OS plutôt que le
 * thème choisi sur le site. On inline donc le SVG dans le HTML, puis on duplique
 * ses règles sombres en les préfixant par `[data-bs-theme="dark"]`.
 *
 * Doit tourner AVANT l'AssetsProcessor de Stenope, qui réécrit les `src` en URL
 * publique — d'où la priorité portée par `#[AsTaggedItem]`.
 */
#[AutoconfigureTag('stenope.processor')]
#[AsTaggedItem(priority: 100)]
readonly class D2DiagramProcessor implements ProcessorInterface
{
    /** Media query émise par D2 lorsqu'on lui passe `--dark-theme`. */
    private const string DARK_MEDIA_QUERY = '@media screen and (prefers-color-scheme:dark){';

    /** Attribut présent sur la racine de tout SVG produit par D2. */
    private const string D2_MARKER = 'data-d2-version';

    public function __construct(
        private AssetMapperInterface $assetMapper,
        private HtmlCrawlerManagerInterface $crawlers,
        private string $property = 'content',
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
        $source = $this->readD2Source($element->getAttribute('src'));

        if (\is_null($source)) {
            return false;
        }

        $svg = $this->importSvg($element, $this->bindDarkThemeToDataAttribute($source));

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

        $element->parentNode?->replaceChild($svg, $element);

        return true;
    }

    /**
     * Lit le fichier source d'un asset local, s'il s'agit bien d'un SVG D2.
     */
    private function readD2Source(string $src): ?string
    {
        if (!str_ends_with($src, '.svg')) {
            return null;
        }

        $asset = $this->assetMapper->getAsset($src);

        if (\is_null($asset) || !is_readable($asset->sourcePath)) {
            return null;
        }

        $contents = file_get_contents($asset->sourcePath);

        if (false === $contents || !str_contains($contents, self::D2_MARKER)) {
            return null;
        }

        return $contents;
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
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }

        if (!$loaded || \is_null($document->documentElement) || \is_null($element->ownerDocument)) {
            return null;
        }

        $imported = $element->ownerDocument->importNode($document->documentElement, true);

        return $imported instanceof \DOMElement ? $imported : null;
    }

    /**
     * Duplique les règles sombres du SVG pour qu'elles répondent aussi au thème
     * choisi sur le site, et non uniquement aux préférences de l'OS.
     *
     * Les règles d'origine restent dans la media query mais sont neutralisées
     * quand le visiteur force le thème clair.
     */
    private function bindDarkThemeToDataAttribute(string $svg): string
    {
        $start = strpos($svg, self::DARK_MEDIA_QUERY);

        if (false === $start) {
            return $svg;
        }

        $open = $start + \strlen(self::DARK_MEDIA_QUERY);
        $close = $this->findClosingBrace($svg, $open);

        if (\is_null($close)) {
            return $svg;
        }

        $rules = substr($svg, $open, $close - $open);

        return substr($svg, 0, $open)
            . $this->prefixSelectors($rules, ':root:not([data-bs-theme="light"])')
            . '}'
            . $this->prefixSelectors($rules, '[data-bs-theme="dark"]')
            . substr($svg, $close + 1);
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
     * Préfixe chaque sélecteur d'une liste de règles CSS plates.
     *
     * D2 scope déjà toutes ses règles sombres par `.d2-<id>` : il n'y a donc ni
     * imbrication ni at-rule à gérer ici.
     */
    private function prefixSelectors(string $rules, string $prefix): string
    {
        return preg_replace_callback(
            '/([^{}]+)\{([^{}]*)\}/',
            static function (array $matches) use ($prefix): string {
                $selectors = array_map(
                    static fn (string $selector): string => \sprintf('%s %s', $prefix, trim($selector)),
                    explode(',', $matches[1]),
                );

                return \sprintf('%s{%s}', implode(',', $selectors), $matches[2]);
            },
            $rules,
        ) ?? $rules;
    }
}
